<?php
/**
 * Footer template for dice-nerdwallet
 *
 * @package dice-nerdwallet
 */
?>

<footer class="fa-footer">
    <div class="fa-container">
        <nav class="fa-footer__links" aria-label="Footer Navigation">
            <?php
            wp_nav_menu([
                'theme_location' => 'footer',
                'container'      => false,
                'fallback_cb'    => false,
            ]);
            ?>
        </nav>
        <p class="fa-footer__disclaimer">
            <?php echo esc_html( get_option( 'blogdescription' ) ); ?>
        </p>
    </div>
</footer>

</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>