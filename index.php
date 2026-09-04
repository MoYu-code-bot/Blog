<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<main class="moyu-home">
    <?php get_template_part('template-parts/navigation'); ?>
    <div class="moyu-archive-layout">
        <section class="moyu-posts moyu-glass">
            <h1><?php echo is_search() ? '搜索结果' : '全部文章'; ?></h1>
            <hr class="moyu-heading-rule">
            <?php get_template_part('template-parts/post-timeline', null, ['query' => $GLOBALS['wp_query']]); ?>
            <nav class="moyu-pagination" aria-label="文章分页">
                <?php the_posts_pagination(['mid_size' => 1, 'prev_text' => '上一页', 'next_text' => '下一页']); ?>
            </nav>
        </section>
    </div>
    <?php get_template_part('template-parts/footer'); ?>
</main>
<?php wp_footer(); ?>
</body>
</html>
