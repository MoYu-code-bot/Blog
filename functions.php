<?php

if (!defined('ABSPATH')) {
    exit;
}

function moyu_glass_setup(): void
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('responsive-embeds');
    add_theme_support('html5', ['search-form', 'gallery', 'caption', 'style', 'script']);
}
add_action('after_setup_theme', 'moyu_glass_setup');

function moyu_glass_assets(): void
{
    $version = wp_get_theme()->get('Version');
    wp_enqueue_style('moyu-glass', get_stylesheet_uri(), [], $version);
    wp_enqueue_script('moyu-glass-glow', get_theme_file_uri('assets/js/mouse-glow.js'), [], $version, true);
}
add_action('wp_enqueue_scripts', 'moyu_glass_assets');

function moyu_glass_articles_url(): string
{
    $page_id = (int) get_option('page_for_posts');
    return $page_id ? get_permalink($page_id) : home_url('/?post_type=post');
}

function moyu_glass_about_url(): string
{
    $page = get_page_by_path('about');
    return $page ? get_permalink($page) : home_url('/about/');
}

function moyu_glass_archive_size(WP_Query $query): void
{
    if (!is_admin() && $query->is_main_query() && ($query->is_home() || $query->is_archive() || $query->is_search())) {
        $query->set('posts_per_page', 10);
    }
}
add_action('pre_get_posts', 'moyu_glass_archive_size');

function moyu_glass_count_page_view(): void
{
    if (is_admin() || is_preview() || is_feed() || wp_doing_ajax() || wp_doing_cron() || current_user_can('manage_options')) {
        return;
    }

    update_option('moyu_glass_page_views', (int) get_option('moyu_glass_page_views', 0) + 1, false);
}
add_action('template_redirect', 'moyu_glass_count_page_view');

function moyu_glass_reading_minutes(?int $post_id = null): int
{
    $content = wp_strip_all_tags(get_post_field('post_content', $post_id ?: get_the_ID()));
    preg_match_all('/[\p{Han}]|[A-Za-z0-9]+/u', $content, $matches);
    return max(1, (int) ceil(count($matches[0]) / 300));
}

function moyu_glass_customize(WP_Customize_Manager $customizer): void
{
    $customizer->add_section('moyu_profile', [
        'title' => 'MY Blog 左侧栏',
        'priority' => 30,
    ]);

    $fields = [
        'moyu_brand' => ['顶部名称', 'MY Blog'],
        'moyu_profile_name' => ['个人名称', '你好，我是墨雨'],
        'moyu_profile_intro' => ['个人简介', '记录技术、生活与持续成长'],
        'moyu_skills_title' => ['技能标题', '我擅长的事'],
        'moyu_skill_1' => ['技能一', '技术写作'],
        'moyu_skill_2' => ['技能二', '网站开发'],
        'moyu_skill_3' => ['技能三', '持续学习'],
        'moyu_skill_4' => ['技能四', '经验分享'],
        'moyu_stats_title' => ['统计标题', '站点统计'],
        'moyu_tags_title' => ['标签标题', '标签'],
        'moyu_updated_title' => ['更新标题', '最近更新'],
    ];

    foreach ($fields as $id => [$label, $default]) {
        $customizer->add_setting($id, ['default' => $default, 'sanitize_callback' => 'sanitize_text_field']);
        $customizer->add_control($id, ['section' => 'moyu_profile', 'label' => $label, 'type' => 'text']);
    }

    $customizer->add_setting('moyu_personal_tags', ['default' => '', 'sanitize_callback' => 'sanitize_textarea_field']);
    $customizer->add_control('moyu_personal_tags', [
        'section' => 'moyu_profile',
        'label' => '个人标签',
        'description' => '使用逗号、中文逗号或换行分隔，可添加多个标签。',
        'type' => 'textarea',
    ]);

    $customizer->add_setting('moyu_profile_avatar', [
        'default' => get_theme_file_uri('assets/images/avatar.png'),
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $customizer->add_control(new WP_Customize_Image_Control($customizer, 'moyu_profile_avatar', [
        'section' => 'moyu_profile',
        'label' => '个人头像',
    ]));

    foreach (['moyu_profile_site' => '个人网站链接', 'moyu_profile_github' => 'GitHub 链接'] as $id => $label) {
        $customizer->add_setting($id, ['default' => '', 'sanitize_callback' => 'esc_url_raw']);
        $customizer->add_control($id, ['section' => 'moyu_profile', 'label' => $label, 'type' => 'url']);
    }

    $customizer->add_section('moyu_footer', [
        'title' => 'MY Blog 页脚',
        'priority' => 31,
    ]);
    foreach ([
        'moyu_footer_copyright' => ['版权文字', '©2026墨雨的博客网站'],
        'moyu_footer_slogan' => ['页脚文案', 'Stay curious, keep learning, and grow a little every day.'],
    ] as $id => [$label, $default]) {
        $customizer->add_setting($id, ['default' => $default, 'sanitize_callback' => 'sanitize_text_field']);
        $customizer->add_control($id, ['section' => 'moyu_footer', 'label' => $label, 'type' => 'text']);
    }
}
add_action('customize_register', 'moyu_glass_customize');
