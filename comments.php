<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<section class="moyu-comments">
    <?php if (have_comments()) : ?>
        <h2><?php echo esc_html(sprintf('评论（%d）', get_comments_number())); ?></h2>
        <ol class="moyu-comment-list">
            <?php wp_list_comments(['style' => 'ol', 'avatar_size' => 48, 'short_ping' => true]); ?>
        </ol>
        <?php the_comments_pagination(['prev_text' => '上一页', 'next_text' => '下一页']); ?>
    <?php endif; ?>

    <?php comment_form([
        'title_reply' => '发表评论',
        'label_submit' => '提交评论',
        'comment_notes_after' => '<p class="comment-notes">评论提交后需要管理员审核，审核通过后才会公开显示。</p>',
    ]); ?>
</section>
