<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ZH-Blog
 */

// Get options
$options = get_option( 'zh_blog' ); // unique id of the framework

// echo "<pre>";
// var_dump($options['zh_footer_logo']);
// exit;

?>

    <!-- Footer Start -->
    <footer id="main_footer">
        <div class="container">
            <div class="row-1">
                <div class="contact-form">
                    <div class="heading"><?php echo $options['zh_footer_newsletter_title']; ?></div>
                    <form action="#">
                        <input class="email" type="email" placeholder="Enter Your Email">
                        <input class="submit-button" type="submit" value="Subscribe Now">
                    </form>
                </div>
            </div>
            <div class="row-2">
                <div class="column-1 column">
                    <div class="logo heading">
                        <a href="/">
                            <img width="100" height="100" src="<?php echo $options['zh_footer_logo']['url'] ?>" alt="Footer Logo">
                        </a>
                    </div>
                    <div class="brief-info">
                        <p>
                            <?php echo $options['zh_footer_description'] ?>
                        </p>
                    </div>
                </div>
                <div class="column-2 column">
                    <div class="heading"><?php echo $options['zh_footer_menu_one'] ?></div>
                    <div class="links">
                    <?php wp_nav_menu( 
                        array( 
                            'theme_location' => 'footer-menu-1',
                            'container' => false
                        )); 
                    ?>
                    </div>
                </div>
                <div class="column-3 column">
                    <div class="heading"><?php echo $options['zh_footer_menu_two'] ?></div>
                    <div class="links">
                    <?php wp_nav_menu( 
                        array( 
                            'theme_location' => 'footer-menu-2',
                            'container' => false
                        )); 
                    ?>
                    </div>
                </div>
            </div>
            <div class="row-3">
                <div class="copy-rights">
                    <?php echo $options['zh_footer_copyright'] ?>
                </div>
                <div class="nav-links">
                    <nav>
                    <?php wp_nav_menu( 
                        array( 
                            'theme_location' => 'footer-menu-3',
                            'container' => false
                        )); 
                    ?>
                    </nav>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer End -->
    <?php wp_footer(); ?>
    </body>
</html>
