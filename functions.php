<?php
/**
 * wordpress_project_03 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wordpress_project_03
 */

if ( ! function_exists( 'wordpress_project_03_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function wordpress_project_03_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on wordpress_project_03, use a find and replace
		 * to change 'wordpress_project_03' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'wordpress_project_03', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'automatic-feed-' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size('portrait-blog', 200, 9999);
		add_image_size( 'student-featured', 200, 300, true );


		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'wordpress_project_03' ),
			'footer-contact' => esc_html__('Footer Contact Menu', 'wordpress_project_03'),
			'footer-sitemap' => esc_html__('Footer Sitemap Menu', 'wordpress_project_03'),
			'social-media' => esc_html__('Social Media Menu', 'wordpress_project_03'),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'wordpress_project_03_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'wordpress_project_03_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wordpress_project_03_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'wordpress_project_03_content_width', 640 );
}
add_action( 'after_setup_theme', 'wordpress_project_03_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wordpress_project_03_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'wordpress_project_03' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'wordpress_project_03' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'wordpress_project_03_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wordpress_project_03_scripts() {
	// ** Add google font
	wp_enqueue_style('pjt-googlefont-Montserrat', 'https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,900');

	wp_enqueue_style( 'wordpress_project_03-style', get_stylesheet_uri() );

	wp_enqueue_script( 'wordpress_project_03-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'wordpress_project_03-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	// ***************************************
	//**  Enqueue Slick Slider only on Home page
	// ***************************************
	if ( is_front_page() ) {

		// ** Load slick.min js
		wp_enqueue_script(
			'pjt-slickslider',
			get_template_directory_uri() . '/js/slick.min.js',
			array('jquery'),
			'20190901',
			true
		);

		// ** Load slick setting
		wp_enqueue_script(
			'pjt-slickslider-settings',
			get_template_directory_uri() . '/js/slick-settings.js',
			array('jquery', 'pjt-slickslider'),
			'20190901',
			true
		);

		// ** Load css
		wp_enqueue_style(
			'pjt-slicktheme',
			get_template_directory_uri() . '/css/slick-theme.css'	
		);
		wp_enqueue_style(
			'pjt-slick',
			get_template_directory_uri() . '/css/slick.css'
		);
	}


	// ****************************************
	// ** Scroll To Top ** with Loading CSS
	// ****************************************
	wp_enqueue_style(
		'scroll-to-top',
		get_template_directory_uri() . '/css/scroll-to-top.css'	
	);
	wp_enqueue_script( 
		'scroll-to-top', 
		get_template_directory_uri() . '/js/scroll-to-top.js', 
		array( 'jquery' ), 
		'20190827',
		true 
	);


	// ****************************************
	// ** Scroll Reveal Animation ** 
	// ****************************************
	wp_enqueue_script('scroll-reveal', "https://unpkg.com/scrollreveal/dist/scrollreveal.min.js");
	wp_enqueue_script('scroll-reveal-script', get_template_directory_uri() .'/js/scroll-reveal.js',	array( 'jquery' ), 
	'20190907',
	true );

	
	// ***************************************
	// ** REST API EXAMPLE
	// ***************************************
	if ( is_front_page() ) {
		wp_enqueue_script( 'twdwp-rest-api', get_template_directory_uri() . '/js/twdwp-rest-api.js', array( 'jquery' ), '20190422', false );
		wp_localize_script( 'twdwp-rest-api', 'rest_object', array( 'api_url' => site_url( '/wp-json/wp/v2/' ) ) );
	}	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wordpress_project_03_scripts' );



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
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// ***************************************
// ** Register CPTs and Taxonommies
// ***************************************
require get_template_directory() . '/inc/register-cpt-tax.php';

// ***************************************
// ** this changes excerpt() default 55 to 20 words.
// ***************************************
function pjt_excerpt_length ( $length ) {
	return 25;
}
add_filter('excerpt_length', 'pjt_excerpt_length', 999);

// ***************************************
// ** this changes excerpt_more value 
// ***************************************
function pjt_excerpt_more ( $more ) {
	$read_more = '...<a class="read-more" href="' . get_permalink() . '">Read More✨</a>';
	return $read_more;
}
add_filter('excerpt_more', 'pjt_excerpt_more');


// ***************************************
// ** Register ACF Block Types
// ***************************************
require get_template_directory() . '/blocks/register-blocks.php';
