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
    <div class="moyu-page-layout">
        <?php while (have_posts()) : the_post(); ?>
            <article <?php post_class('moyu-reader moyu-glass'); ?>>
                <h1><?php the_title(); ?></h1>
                <div class="moyu-article-content"><?php the_content(); ?></div>
            </article>
        <?php endwhile; ?>
    </div>
    <?php get_template_part('template-parts/footer'); ?>
</main>
<?php wp_footer(); ?>
</body>
</html>
