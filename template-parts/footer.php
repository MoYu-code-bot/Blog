<?php if (!defined('ABSPATH')) { exit; } ?>
<footer class="moyu-footer">
    <strong><?php echo esc_html(get_theme_mod('moyu_footer_copyright', '©2026墨雨的博客网站')); ?></strong>
    <span><?php echo esc_html(get_theme_mod('moyu_footer_slogan', 'Stay curious, keep learning, and grow a little every day.')); ?></span>
</footer>
<?php
$contact_email = get_theme_mod('moyu_contact_email', '');
$contact_qq = get_theme_mod('moyu_contact_qq', '');
?>
<?php if ($contact_email || $contact_qq) : ?>
    <nav class="moyu-contact" aria-label="联系方式">
        <?php if ($contact_email) : ?>
            <a href="mailto:<?php echo esc_attr($contact_email); ?>" aria-label="发送电子邮件" title="E-mail">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 5h18a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Zm9 8 8-5H4l8 5Zm0 2.3L3 9.7V17h18V9.7l-9 5.6Z"/></svg>
            </a>
        <?php endif; ?>
        <?php if ($contact_qq) : ?>
            <a href="https://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo esc_attr($contact_qq); ?>&amp;site=qq&amp;menu=yes" target="_blank" rel="noopener" aria-label="通过 QQ 联系" title="QQ">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2c-3.8 0-6.3 3.2-6.3 7.5 0 .8.1 1.6.3 2.3-.7 1-1.4 2.4-1.1 3.1.2.4.9.3 1.7-.1.2 1.8 1.7 3.3 3.7 3.9.5.2 1 .3 1.7.3s1.2-.1 1.7-.3c2-.6 3.5-2.1 3.7-3.9.8.4 1.5.5 1.7.1.3-.7-.4-2.1-1.1-3.1.2-.7.3-1.5.3-2.3C18.3 5.2 15.8 2 12 2Zm-2.3 7.6c-.6 0-1-.7-1-1.5s.4-1.5 1-1.5 1 .7 1 1.5-.4 1.5-1 1.5Zm4.6 0c-.6 0-1-.7-1-1.5s.4-1.5 1-1.5 1 .7 1 1.5-.4 1.5-1 1.5Z"/></svg>
            </a>
        <?php endif; ?>
    </nav>
<?php endif; ?>
