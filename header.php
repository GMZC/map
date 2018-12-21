<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Les_Autres_Possibles
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php
                    get_template_part('template-parts/svg/content', 'sprite');
            ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'map'); ?></a>

	<header id="masthead" class="site-header">
		<nav id="site-navigation-1" class="main-navigation">
			<button class="hamburger hamburger--arrow menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</button>
			<div class="left-menu">
				<?php
                wp_nav_menu(array(
                    'theme_location' => 'menu-1',
                ));
                ?>
			</div>

			<div class="site-branding">
				<div class="">
						<a href="<?php bloginfo('url'); ?>">
										<?php
                            get_template_part('template-parts/svg/navigation', 'logo');
                        ?>
						</a>
						<div class="slogan">
							<?php bloginfo('description'); ?>
						</div>
				</div>
			</div><!-- .site-branding -->
			<div class="right-menu">
				<?php
                            wp_nav_menu(array(
                                    'theme_location' => 'menu-2',
                            ));
                            ?>
				<ul>
				<?php if (is_user_logged_in()) {
                                ?>
					<li>
						 <a class="monCompte" href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" title="<?php _e('Mon Compte', 'woothemes'); ?>">
							 <svg class="icon">
								 <use xlink:href="#map"></use>
							 </svg>

							 <span> <?php _e('Mon Compte', 'woothemes'); ?></span>
						 </a>
					 </li>
				 <?php
                            } else {
                                ?>
					<li>
						<a class="monCompte" href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" title="<?php _e('Connexion / Inscription', 'woothemes'); ?>">
							<svg class="icon">
								<use xlink:href="#map"></use>
							</svg>
							<span> <?php _e('Connexion <br> Inscription', 'woothemes'); ?></span>
						</a>
					</li>
				 <?php
                            } ?>
				</ul>
					<?php
                                            if (function_exists('map_woocommerce_header_cart')) {
                                                map_woocommerce_header_cart();
                                            }
                                    ?>
			</div>

		</nav><!-- #site-navigation -->

	</header><!-- #masthead -->

	<div id="content" class="site-content">
