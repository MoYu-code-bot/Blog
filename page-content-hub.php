<?php
/* Template Name: Moyu 内容专题 */
if (!defined('ABSPATH')) {
    exit;
}

$slug = get_post_field('post_name', get_the_ID());
$hub = moyu_glass_hubs()[$slug] ?? null;
$term = $hub && $hub['category'] ? get_term_by('name', $hub['category'], 'category') : null;
$hub_posts = $term ? new WP_Query([
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => 10,
    'category__in' => [$term->term_id],
]) : null;
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
        <?php while (have_posts()) : the_post(); ?>
            <section class="moyu-hub-intro moyu-glass">
                <span class="moyu-hub-kicker"><?php echo $slug === 'community' ? 'COMMUNITY' : 'CONTENT HUB'; ?></span>
                <h1><?php the_title(); ?></h1>
                <div class="moyu-article-content"><?php the_content(); ?></div>
            </section>
        <?php endwhile; ?>

        <?php if ($hub && $hub['category']) : ?>
            <section class="moyu-posts moyu-glass">
                <h2>相关文章</h2>
                <hr class="moyu-heading-rule">
                <?php if ($hub_posts) : ?>
                    <?php get_template_part('template-parts/post-timeline', null, ['query' => $hub_posts]); ?>
                <?php else : ?>
                    <p class="moyu-empty">该分类暂时还没有文章。</p>
                <?php endif; ?>
            </section>
        <?php endif; ?>
    </div>
    <?php get_template_part('template-parts/footer'); ?>
</main>
<?php wp_footer(); ?>
</body>
</html>
