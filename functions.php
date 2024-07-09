<?php
/**
 * ZH-Blog functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ZH-Blog
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function zhblog_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on ZH-Blog, use a find and replace
		* to change 'zhblog' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'zhblog', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

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

	register_nav_menus(
		array(
			'footer-menu-1' => esc_html__( 'Footer Menu One', 'zhblog' ),
			'footer-menu-2' => esc_html__( 'Footer Menu Two', 'zhblog' ),
			'footer-menu-3' => esc_html__( 'Footer Menu Three', 'zhblog' ),
			'header-menu' => esc_html__( 'Header Main Menu', 'zhblog' ),
		)
	);


	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'zhblog_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'zhblog_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function zhblog_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'zhblog_content_width', 640 );
}
add_action( 'after_setup_theme', 'zhblog_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function zhblog_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'zhblog' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'zhblog' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'zhblog_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function zhblog_scripts() {
	// Google Fonts CSS Abel and Roboto
	wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css2?family=Abel&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

	// Font Awesome Icons
	wp_enqueue_style('font-awesome', '//use.fontawesome.com/releases/v5.15.4/css/all.css');

	wp_enqueue_style( 'zhblog-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'zhblog-style', 'rtl', 'replace' );

	wp_enqueue_script( 'zhblog-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'zhblog-custom-js', get_template_directory_uri() . '/js/theme.js', ["jquery"], false, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'zhblog_scripts' );

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

add_filter( 'comment_form_default_fields', 'wpsites_comment_form_fields' );

function wpsites_comment_form_fields( $fields ) {

    unset($fields['url']);

	$fields['author'] = '<div class="row-1"><input placeholder="Your Name *" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />';

	$fields['email']  = '<input placeholder="Your Email *" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>';

	return $fields;
}

// Comment form: Add placeholder to comment field 
add_filter( 'comment_form_defaults', 'comment_form_field_text_area' );

function comment_form_field_text_area( $defaults ) {

	$defaults['title_reply'] = __( '' );
	$defaults['label_submit'] = __( 'Leave a Comment', 'custom' );
	$defaults['submit_button'] = '<input class="btn" name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />';

	$defaults['comment_field'] = '<p class="comment-form-comment"><label class="screen-reader-text" for="comment">' . _x( 'Comment', 'noun' ) . '</label> <textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required" placeholder="' . _x( 'Your Comment *', 'noun' ) . '"></textarea></p>';
    
    return $defaults;
}

add_filter( 'comment_form_fields', 'move_comment_field' );
function move_comment_field( $fields ) {
    $comment_field = $fields['comment'];
    $author_field = $fields['author'];
    $email_field = $fields['email'];
    $cookies_field = $fields['cookies'];

    unset( $fields['comment'] );
    unset( $fields['author'] );
    unset( $fields['email'] );
    unset( $fields['cookies'] );

    $fields['author'] = $author_field;
    $fields['email'] = $email_field;
    $fields['comment'] = $comment_field;
    $fields['cookies'] = $cookies_field;
    return $fields;
}


// views file

function gt_get_post_view() {
    $count = get_post_meta( get_the_ID(), 'post_views_count', true );
    return "$count";
}


function gt_set_post_view() {
    $key = 'post_views_count';
    $post_id = get_the_ID();
    $count = (int) get_post_meta( $post_id, $key, true );
    $count++;
    update_post_meta( $post_id, $key, $count );
}


function gt_posts_column_views( $columns ) {
    $columns['post_views'] = 'Views';
    return $columns;
}


function gt_posts_custom_column_views( $column ) {
    if ( $column === 'post_views') {
        echo gt_get_post_view();
    }
}


add_filter( 'manage_posts_columns', 'gt_posts_column_views' );
add_action( 'manage_posts_custom_column', 'gt_posts_custom_column_views' );

function replace_icon_with_text( $string ){
	if ( is_singular() ) {
		$pattern = '<i class="fas fa-thumbs-up"></i>';
		$replacement = 'Like';
		
		$content = str_replace($pattern, $replacement, $string);
		return $content;
	}     
}
add_filter('the_content', 'replace_icon_with_text');


	
add_post_type_support( 'page', 'excerpt' );


// Codestar frameWork

// Control core classes for avoid errors
if( class_exists( 'CSF' ) ) {

	//
	// Set a unique slug-like ID
	$prefix = 'zh_blog';
  
	//
	// Create options
	CSF::createOptions( $prefix, array(
	  'menu_title' => 'ZH Blog Controls',
	  'menu_slug'  => 'zh-blog',
	));
  
	//
	// Create Home section
	CSF::createSection( $prefix, array(
	  'title'  => 'Home Page Controls',
	  'fields' => array(
  
		// Home Section Fields

		array(
			'id'    => 'zh_home_page_image',
			'type'  => 'media',
			'title' => 'Home Header Image',
			'default' => array(
				'url' => 'https://images.unsplash.com/photo-1637766717192-0f2d350ba7ee?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1374&q=80'
			)
		),

		array(
			'id'      => 'zh_top_title_home',
			'type'    => 'text',
			'title'   => 'Home Header Title Top',
			'default' => 'PLACE'
		),

		array(
			'id'      => 'zh_bottom_title_home',
			'type'    => 'text',
			'title'   => 'Home Header Title Bottom',
			'default' => 'PERFECT'
		),

		array(
			'type'    => 'subheading',
			'content' => 'Section-1 ( Left Image and Right Text )',
		),

		array(
			'id'    => 'zh_page_image',
			'type'  => 'media',
			'title' => 'Block Image',
			'default' => array(
				'url' => 'https://images.unsplash.com/photo-1637766717192-0f2d350ba7ee?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1374&q=80'
			)
		),

		array(
			'id'      => 'zh_top_title_page',
			'type'    => 'text',
			'title'   => 'First Title',
			'default' => 'DREAM BIG'
		),

		array(
			'id'      => 'zh_bottom_title_page',
			'type'    => 'text',
			'title'   => 'Second Title',
			'default' => 'LIVE BIG'
		),

		array(
			'id'      => 'zh_blog_description',
			'type'    => 'textarea',
			'title'   => 'Description',
			'default' => 'Having a dream and being able to finally make it true is the best feeling ever. We encourage you to have big dreams and find inspiration for reaching your goals in the countries and places you have never seen.

			Having a dream and being able to finally make it true is the best feeling ever. We encourage you to have big dreams and find inspiration for reaching your goals in the countries and places you have never seen.'
		),

		array(
			'id'    => 'zh_page_button',
			'type'  => 'link',
			'title' => 'Button',
			'default' => [
				'url' => '#',
				'text' => 'Read More About Us',
				'target' => '_blank'

			]
		),	
		
		array(
			'id'      => 'zh_featured-post-top',
			'type'    => 'text',
			'title'   => 'Text',
			'default' => 'Dream Big'
		),

		array(
			'id'      => 'zh_featured-post-bottom',
			'type'    => 'text',
			'title'   => 'Text',
			'default' => 'Journey Big'
		),
		  
		  
		  
		  
  
	  )
	) );
  
	//
	// Create a section
	CSF::createSection( $prefix, array(
	  'title'  => 'Footer',
	  'fields' => array(
  
		//
		// A text field
		array(
			'id'    => 'zh_footer_logo',
			'type'  => 'media',
			'title' => 'Footer Logo',
			'default' => [
				'url' => 'https://images.unsplash.com/photo-1599305445671-ac291c95aaa9?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1469&q=80'
			]
		),

		array(
			'id'      => 'zh_footer_newsletter_title',
			'type'    => 'text',
			'title'   => 'Newsletter Title',
			'default' => 'Get News'
		),

		array(
			'id'      => 'zh_footer_description',
			'type'    => 'textarea',
			'title'   => 'Footer Description',
			'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas at dignissim mauris. Donec sed dapibus diam. Proin id pulvinar justo. Duis tristique enim a aliquam laoreet. Vivamus turpis orci, placerat viverra nunc non, rhoncus rutrum nisl. Nunc finibus consectetur molestie. Aliquam vitae pharetra sapien, vel posuere arcu.'
		),

		array(
			'id'      => 'zh_footer_menu_one',
			'type'    => 'text',
			'title'   => 'Menu One Heading',
			'default' => 'Useful Links'
		),
		
		array(
			'id'      => 'zh_footer_menu_two',
			'type'    => 'text',
			'title'   => 'Menu Two Heading',
			'default' => 'Useful Links'
		),

		array(
			'type'    => 'subheading',
			'content' => 'Footer Bottom',
		),

		array(
			'id'      => 'zh_footer_copyright',
			'type'    => 'text',
			'title'   => 'Copy Right Text',
			'default' => 'ZH Blog © 2022. ALL RIGHTS RESERVED.'
		),
  
	  )
	) );

	//
	// Create a section
	CSF::createSection( $prefix, array(
		'title'  => 'Header',
		'fields' => array(
	
		  //
		  // A text field
		  array(
			  'id'    => 'zh_header_logo',
			  'type'  => 'media',
			  'title' => 'Header Logo',
			  'default' => [
				  'url' => 'https://images.unsplash.com/photo-1599305445671-ac291c95aaa9?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1469&q=80'
			  ]
		   ),
	
		)
	) );

		//
	// Create a section
	CSF::createSection( $prefix, array(
		'title'  => 'Social Media Links',
		'fields' => array(
	
		  //
		  // A text field
		  array(
			'id'       => 'face-book-link',
			'type'     => 'link',
			'title'    => 'Facebook Link',
			'default'  => array(
			  'url'    => 'http://facebook.com/',
			  'text'   => 'Facebook Link',
			  'target' => '_blank'
			),
		  ),

		  array(
			'id'       => 'twitter-link',
			'type'     => 'link',
			'title'    => 'Twitter Link',
			'default'  => array(
			  'url'    => 'http://twitter.com/',
			  'text'   => 'Twitter Link',
			  'target' => '_blank'
			),
		  ),
	
		)
	) );

  
  }
  

  function add_additional_class_on_li($classes, $item, $args) {
    if(isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);