<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ZH-Blog
 */

 // Get options
$options = get_option( 'zh_blog' ); // unique id of the framework

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php if (has_post_thumbnail( $post->ID ) && !is_home() ){ ?>
  <?php $bgimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 
}
else{
    $bgimage[0] = $options['zh_home_page_image']['url'];
}
 ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'zhblog' ); ?></a>
        <!-- Header Start -->
        <header id="main_header" style="background-image: linear-gradient(0deg, rgba(0, 0, 0, 0.56), rgba(0, 0, 0, 0.56)), url('<?php echo $bgimage[0]; ?>');">
            <div class="container">
                <div class="header-nav">
                    <div class="logo">
                        <a href="/">
                            <img width="100" height="100" src="<?php echo $options['zh_header_logo']['url'] ?>" alt="Header Logo">
                        </a>
                    </div>
                    <button class="bar-button btn">
                        <i class="fas fa-bars"></i>
                    </button>
                    <nav id="navigation" class="navigation">
                        <?php wp_nav_menu( 
                            array( 
                                'theme_location' => 'header-menu',
                                'container' => false,
                                'menu_class' => 'main-parent-li-wrapper',
                                'add_li_class'  => 'li-item-parent'
                            )); 
                        ?>
                    </nav>
                </div>
                <div class="header-title">
                    <?php if( is_home() ){
                    ?>
                        <h1>
                            <span class="top"><?php echo $options['zh_top_title_home'] ?></span>
                            <span class="bottom"><?php echo $options['zh_bottom_title_home'] ?></span>
                        </h1>
                    <?php
                    }
                    else
                    if(is_category()){
                        ?>
                        <h1 style="letter-spacing:2px;">
                            <span class="top"><?php single_cat_title(); ?></span>
                        </h1>
                        <?php
                    }else
                    if(is_tag()){
                        ?>
                        <h1 style="letter-spacing:2px;">
                            <span class="top"><?php single_tag_title(); ?></span>
                        </h1>
                        <?php
                    }else
                    if( is_search() ){
                        ?>
                        <h1 style="letter-spacing:2px;">
                            <span class="top"><?php echo $_GET['s']; ?></span>
                        </h1>
                        <?php
                    }
                    else{
                        ?>
                        <h1 style="letter-spacing:2px;">
                            <span class="top"><?php the_title(); ?></span>
                        </h1>
                        <?php
                    } ?>
                </div>
            </div>
        </header>
        <!-- Header End -->
