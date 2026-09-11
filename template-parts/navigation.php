<?php
if (!defined('ABSPATH')) {
    exit;
}

$about_page = get_page_by_path('about');
$discover_links = [
    ['technical-notes', '技术笔记', '记录编程与技术成长', 'dashicons-editor-code'],
    ['ai-exploration', 'AI 探索', '关注前沿 AI 与应用', 'dashicons-lightbulb'],
    ['site-building', '建站记录', '从 0 到 1 的网站之旅', 'dashicons-admin-site-alt3'],
    ['life-essays', '生活随笔', '关于生活与思考', 'dashicons-coffee'],
];
?>
<header class="moyu-header moyu-glass">
    <a class="moyu-brand" href="<?php echo esc_url(home_url('/')); ?>">
        <strong><?php echo esc_html(get_theme_mod('moyu_brand', 'MY Blog')); ?></strong>
        <span>记录技术、生活与持续成长</span>
    </a>
    <nav class="moyu-nav" aria-label="主导航">
        <ul>
            <li><a href="<?php echo esc_url(home_url('/')); ?>" <?php if (is_front_page()) : ?>aria-current="page"<?php endif; ?>>首页</a></li>
            <li><a href="<?php echo esc_url(moyu_glass_articles_url()); ?>" <?php if (is_home() || is_archive()) : ?>aria-current="page"<?php endif; ?>>文章</a></li>
            <li class="moyu-category-menu">
                <details>
                    <summary>分类</summary>
                    <div class="moyu-mega-menu moyu-glass">
                        <?php foreach ($discover_links as [$slug, $title, $description, $icon]) : ?>
                            <a href="<?php echo esc_url(moyu_glass_hub_url($slug)); ?>">
                                <span class="dashicons <?php echo esc_attr($icon); ?>" aria-hidden="true"></span>
                                <strong><?php echo esc_html($title); ?></strong>
                                <small><?php echo esc_html($description); ?></small>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </details>
            </li>
            <li><a href="<?php echo esc_url(moyu_glass_hub_url('community')); ?>" <?php if (is_page('community')) : ?>aria-current="page"<?php endif; ?>>社区</a></li>
            <li><a href="<?php echo esc_url(moyu_glass_about_url()); ?>" <?php if ($about_page && is_page($about_page->ID)) : ?>aria-current="page"<?php endif; ?>>关于我</a></li>
        </ul>
    </nav>
    <form class="moyu-search" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
        <label class="screen-reader-text" for="moyu-search-field">搜索文章</label>
        <input type="hidden" name="post_type" value="post">
        <input id="moyu-search-field" type="search" name="s" value="<?php echo esc_attr(get_search_query()); ?>" placeholder="搜索文章">
    </form>
</header>
