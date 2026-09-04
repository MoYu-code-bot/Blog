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
    <?php while (have_posts()) : the_post(); ?>
        <article <?php post_class('moyu-reader moyu-glass'); ?>>
            <a class="moyu-back" href="<?php echo esc_url(home_url('/')); ?>">返回首页</a>
            <h1><?php the_title(); ?></h1>
            <time class="moyu-date" datetime="<?php echo esc_attr(get_the_date(DATE_W3C)); ?>"><?php echo esc_html(get_the_date('Y年n月j日')); ?></time>
            <div class="moyu-post-meta"><span>阅读 <?php echo esc_html(moyu_glass_reading_minutes()); ?> 分钟</span><span>最后更新：<?php echo esc_html(get_the_modified_date('Y年n月j日')); ?></span></div>
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('large', ['class' => 'moyu-reader-image']); ?>
            <?php endif; ?>
            <div class="moyu-article-content"><?php the_content(); ?></div>
            <?php the_tags('<div class="moyu-single-tags">', '', '</div>'); ?>
            <nav class="moyu-post-navigation" aria-label="相邻文章">
                <div><?php previous_post_link('%link', '上一篇：%title'); ?></div>
                <div><?php next_post_link('%link', '下一篇：%title'); ?></div>
            </nav>
            <?php if (comments_open() || get_comments_number()) : ?>
                <?php comments_template(); ?>
            <?php endif; ?>
        </article>
    <?php endwhile; ?>
    <?php get_template_part('template-parts/footer'); ?>
</main>
<?php wp_footer(); ?>
</body>
</html>
