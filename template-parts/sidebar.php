<?php
if (!defined('ABSPATH')) {
    exit;
}

$published = wp_count_posts('post')->publish;
$page_views = (int) get_option('moyu_glass_page_views', 0);
$tags = get_tags(['number' => 10, 'orderby' => 'count', 'order' => 'DESC']);
$updated = get_posts(['numberposts' => 3, 'post_status' => 'publish', 'orderby' => 'modified', 'order' => 'DESC']);
$profile_site = get_theme_mod('moyu_profile_site');
$profile_github = get_theme_mod('moyu_profile_github');
$personal_tags = preg_split('/[\r\n,，]+/u', get_theme_mod('moyu_personal_tags', ''));
$personal_tags = array_values(array_unique(array_filter(array_map('trim', $personal_tags))));
?>
<aside class="moyu-sidebar" aria-label="博客资料">
    <section class="moyu-profile moyu-glass">
        <img class="moyu-avatar" src="<?php echo esc_url(get_theme_mod('moyu_profile_avatar', get_theme_file_uri('assets/images/avatar.png'))); ?>" alt="个人头像" width="150" height="150">
        <h1><?php echo esc_html(get_theme_mod('moyu_profile_name', '你好，我是墨雨')); ?></h1>
        <p><?php echo esc_html(get_theme_mod('moyu_profile_intro', '记录技术、生活与持续成长')); ?></p>
        <hr class="moyu-rule">
        <h2><?php echo esc_html(get_theme_mod('moyu_skills_title', '我擅长的事')); ?></h2>
        <ul class="moyu-skills">
            <li><?php echo esc_html(get_theme_mod('moyu_skill_1', '技术写作')); ?></li>
            <li><?php echo esc_html(get_theme_mod('moyu_skill_2', '网站开发')); ?></li>
            <li><?php echo esc_html(get_theme_mod('moyu_skill_3', '持续学习')); ?></li>
            <li><?php echo esc_html(get_theme_mod('moyu_skill_4', '经验分享')); ?></li>
        </ul>
        <?php if ($profile_site || $profile_github) : ?>
            <div class="moyu-profile-links">
                <?php if ($profile_site) : ?><a href="<?php echo esc_url($profile_site); ?>">个人网站</a><?php endif; ?>
                <?php if ($profile_github) : ?><a class="moyu-social-link" href="<?php echo esc_url($profile_github); ?>" rel="me" aria-label="GitHub" title="GitHub"><img src="<?php echo esc_url(get_theme_file_uri('assets/images/github.svg')); ?>" alt="" width="28" height="28"></a><?php endif; ?>
            </div>
        <?php endif; ?>
    </section>

    <section class="moyu-side-card moyu-glass">
        <h2><?php echo esc_html(get_theme_mod('moyu_stats_title', '站点统计')); ?></h2>
        <div class="moyu-stats">
            <div><strong><?php echo esc_html($published); ?></strong><span>文章</span></div>
            <div><strong><?php echo esc_html(number_format_i18n($page_views)); ?></strong><span>浏览量</span></div>
        </div>
    </section>

    <?php if ($tags || $personal_tags) : ?>
        <section class="moyu-side-card moyu-glass">
            <h2><?php echo esc_html(get_theme_mod('moyu_tags_title', '标签')); ?></h2>
            <div class="moyu-tags">
                <?php foreach ($tags as $tag) : ?>
                    <a href="<?php echo esc_url(get_tag_link($tag)); ?>"><?php echo esc_html($tag->name); ?></a>
                <?php endforeach; ?>
                <?php foreach ($personal_tags as $personal_tag) : ?>
                    <span><?php echo esc_html($personal_tag); ?></span>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>

    <?php if ($updated) : ?>
        <section class="moyu-side-card moyu-glass">
            <h2><?php echo esc_html(get_theme_mod('moyu_updated_title', '最近更新')); ?></h2>
            <ul class="moyu-updated">
                <?php foreach ($updated as $post) : ?>
                    <li><a href="<?php echo esc_url(get_permalink($post)); ?>"><?php echo esc_html(get_the_title($post)); ?></a><time><?php echo esc_html(get_the_modified_date('n月j日', $post)); ?></time></li>
                <?php endforeach; ?>
            </ul>
        </section>
    <?php endif; ?>
</aside>
