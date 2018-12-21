<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Les_Autres_Possibles
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<?php
                if (! is_active_sidebar('sidebar-4')) {
                    return;
                }
            ?>
			<aside id="secondary" class="widget-area">
				<?php dynamic_sidebar('sidebar-4');
                if (has_nav_menu('social')) : ?>
				<section id="social-navigation" class="widget">
					<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e('Footer Social Links Menu', 'map'); ?>">
						<?php
                            wp_nav_menu(array(
                                'theme_location' => 'social',
                                'menu_class'     => 'social-links-menu',
                                'depth'          => 1,
                                'link_before'    => '<span class="screen-reader-text">',
                                'link_after'     => '</span>' . map_get_svg(array( 'icon' => 'chain' )),
                            ));
                        ?>
					</nav><!-- .social-navigation -->
				</section>
<?php endif; ?>
			</aside><!-- #secondary -->

		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
