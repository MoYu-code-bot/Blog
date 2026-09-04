<?php
if (!defined('ABSPATH')) {
    exit;
}

$posts = new WP_Query([
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'posts_per_page'      => 10,
    'ignore_sticky_posts' => false,
]);
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
<main class="moyu-home" id="home">
    <?php get_template_part('template-parts/navigation'); ?>

    <div class="moyu-layout">
        <?php get_template_part('template-parts/sidebar'); ?>

        <section class="moyu-posts moyu-glass" id="articles">
            <h2>最新文章</h2>
            <hr class="moyu-heading-rule">
            <?php get_template_part('template-parts/post-timeline', null, ['query' => $posts]); ?>
            <a class="moyu-all-posts" href="<?php echo esc_url(moyu_glass_articles_url()); ?>">查看全部文章</a>
        </section>
    </div>

    <?php get_template_part('template-parts/footer'); ?>
</main>
<?php wp_footer(); ?>
</body>
</html>
