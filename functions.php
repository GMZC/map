<?php
/**
 * Les Autres Possibles functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Les_Autres_Possibles
 */

if (! function_exists('map_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function map_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Les Autres Possibles, use a find and replace
         * to change 'map' to the name of your theme in all the template files.
         */
        load_theme_textdomain('map', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'menu-1' => esc_html__('Primary', 'map'),
            'menu-2' => esc_html__('Secondary', 'map'),
            'social' => __('Social Links Menu', 'map')
        ));


        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('map_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ));
    }
endif;
add_action('after_setup_theme', 'map_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function map_content_width()
{
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters('map_content_width', 640);
}
add_action('after_setup_theme', 'map_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function map_widgets_init()
{
    register_sidebar(array(
        'name'          => esc_html__('Bloc QSN', 'map'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'map'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    register_sidebar(array(
        'name'          => esc_html__('Bloc Carte Gmap', 'map'),
        'id'            => 'sidebar-2',
        'description'   => esc_html__('Add widgets here.', 'map'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    register_sidebar(array(
        'name'          => esc_html__('Bloc Boutique', 'map'),
        'id'            => 'sidebar-3',
        'description'   => esc_html__('Add widgets here.', 'map'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    register_sidebar(array(
        'name'          => esc_html__('Footer', 'map'),
        'id'            => 'sidebar-4',
        'description'   => esc_html__('Add widgets here.', 'map'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'map_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function map_scripts()
{
    wp_enqueue_style('map-style', get_stylesheet_uri());

    wp_enqueue_script('map-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0', true);

    wp_enqueue_script('map-ui', get_template_directory_uri() . '/js/ui.js', array(), '1.0', true);

    wp_enqueue_script('map-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '1.0', true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    // wp_dequeue_script('wc-add-to-cart');
    // wp_enqueue_script('wc-add-to-cart', get_template_directory_uri(). '/js/custom-add-to-cart.js', array( 'jquery' ), WC_VERSION);
    global $wp_scripts;
    $wp_scripts->registered[ 'wc-add-to-cart' ]->src = get_template_directory_uri() . '/js/custom-add-to-cart.js';
    $wp_scripts->registered[ 'wc-cart' ]->src = get_template_directory_uri() . '/js/custom-cart.js';
}
add_action('wp_enqueue_scripts', 'map_scripts');

define('WP_SCSS_ALWAYS_RECOMPILE', true);

add_filter('show_admin_bar', '__return_false');



/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if (class_exists('WooCommerce')) {
    require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * SVG icons functions and filters.
 */
require get_template_directory() . '/inc/icon-functions.php';
