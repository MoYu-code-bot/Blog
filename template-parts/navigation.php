<?php
if (!defined('ABSPATH')) {
    exit;
}

$about_page = get_page_by_path('about');
?>
<header class="moyu-header moyu-glass">
    <a class="moyu-brand" href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html(get_theme_mod('moyu_brand', 'MY Blog')); ?></a>
    <nav class="moyu-nav" aria-label="主导航">
        <ul>
            <li><a href="<?php echo esc_url(home_url('/')); ?>" <?php if (is_front_page()) : ?>aria-current="page"<?php endif; ?>>首页</a></li>
            <li><a href="<?php echo esc_url(moyu_glass_articles_url()); ?>" <?php if (is_home() || is_archive()) : ?>aria-current="page"<?php endif; ?>>文章</a></li>
            <li><a href="<?php echo esc_url(moyu_glass_about_url()); ?>" <?php if ($about_page && is_page($about_page->ID)) : ?>aria-current="page"<?php endif; ?>>关于我</a></li>
        </ul>
    </nav>
    <form class="moyu-search" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
        <label class="screen-reader-text" for="moyu-search-field">搜索文章</label>
        <input id="moyu-search-field" type="search" name="s" value="<?php echo esc_attr(get_search_query()); ?>" placeholder="搜索文章">
    </form>
</header>
