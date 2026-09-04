<?php
if (!defined('ABSPATH')) {
    exit;
}

$timeline_query = $args['query'] ?? $GLOBALS['wp_query'];
$current_year = '';
?>
<div class="moyu-timeline">
    <?php if ($timeline_query->have_posts()) : ?>
        <?php while ($timeline_query->have_posts()) : $timeline_query->the_post(); ?>
            <?php $year = get_the_date('Y'); ?>
            <?php if ($year !== $current_year) : $current_year = $year; ?>
                <div class="moyu-year"><span><?php echo esc_html($year); ?></span></div>
            <?php endif; ?>
            <article <?php post_class('moyu-article' . (has_post_thumbnail() ? '' : ' moyu-no-image')); ?>>
                <?php if (has_post_thumbnail()) : ?>
                    <a class="moyu-thumb" href="<?php the_permalink(); ?>" aria-label="阅读《<?php the_title_attribute(); ?>》">
                        <?php the_post_thumbnail('large', ['loading' => 'lazy']); ?>
                    </a>
                <?php endif; ?>
                <div class="moyu-copy">
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <time class="moyu-date" datetime="<?php echo esc_attr(get_the_date(DATE_W3C)); ?>"><?php echo esc_html(get_the_date('Y年n月j日')); ?></time>
                    <div class="moyu-post-meta">
                        <span>阅读 <?php echo esc_html(moyu_glass_reading_minutes()); ?> 分钟</span>
                        <?php $categories = get_the_category(); ?>
                        <?php if ($categories) : ?><a href="<?php echo esc_url(get_category_link($categories[0])); ?>"><?php echo esc_html($categories[0]->name); ?></a><?php endif; ?>
                        <?php if (get_the_modified_date('Ymd') !== get_the_date('Ymd')) : ?><span>更新于 <?php echo esc_html(get_the_modified_date('Y年n月j日')); ?></span><?php endif; ?>
                    </div>
                    <div class="moyu-excerpt"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 34, '…')); ?></div>
                    <a class="moyu-button" href="<?php the_permalink(); ?>">阅读文章</a>
                </div>
            </article>
        <?php endwhile; ?>
    <?php else : ?>
        <p class="moyu-empty">暂时还没有文章。</p>
    <?php endif; ?>
</div>
<?php wp_reset_postdata(); ?>
