<?php get_header(); ?>

<?php
// Get options
$options = get_option( 'zh_blog' ); // unique id of the framework

// echo "<pre>";
// var_dump($options['opt-text-1']);
// die;
?>

<!-- About Us Section Start -->
<section id="about_us">
    <div class="container">
        <div class="left-side">
            <img src="<?php echo $options['zh_page_image']['url']; ?>" alt="<?php echo $options['zh_page_image']['alt']; ?>">
        </div>
        <div class="right-side">
            <h2>
                <span class="dull"><?php echo $options['zh_top_title_page'] ?></span>
                <span class="dark"><?php echo $options['zh_bottom_title_page'] ?></span>
            </h2>
            <p>
             <?php echo $options['zh_blog_description'] ?>
            </p>
            <a class="button" target="<?php echo $options['zh_page_button']['target'] != '' ? "_blank" : '';  ?>" href="<?php echo $options['zh_page_button']['url'] ?>"><?php echo $options['zh_page_button']['text'] ?></a>
        </div>
    </div>
</section>
<!-- About Us Section End -->

<!-- Feature Posts Section Start -->
<section id="feature_posts">
    <div class="container">
        <h2>
            <span class="dull"><?php echo $options['zh_featured-post-top'] ?></span>
            <span class="dark"><?php echo $options['zh_featured-post-bottom'] ?></span>
        </h2>
        <div class="row">

        <?php
            $args = array(  
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => 3, 
                'orderby' => 'date', 
                'order' => 'DESC', 
            );
        
            $featured_posts_loop = new WP_Query( $args ); 
            
            if($featured_posts_loop->have_posts()){
                while($featured_posts_loop->have_posts()){
                    $featured_posts_loop->the_post();
                    ?>
                    <div class="left row-item">
                        <div class="img">
                            <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', TRUE); ?>">
                            <div class="layout">
                                <i class="far fa-plus-square"></i>
                            </div>
                        </div>
                        <div class="info">
                            <h4><?php echo get_the_title(); ?></h4>
                            <a href="<?php echo get_the_permalink(); ?>">View Details<i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <?php
                }
            }
            wp_reset_postdata();
        ?>
            <!-- <div class="middle row-item">
                <div class="img">
                    <img src="http://wpblog.local/wp-content/uploads/2022/02/left-img.jpg" alt="A girl and a boy are walking!">
                    <div class="layout">
                        <i class="far fa-plus-square"></i>
                    </div>
                </div>
                <div class="info">
                    <h4>Plan Your Trip</h4>
                    <a href="#">View Details<i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="right row-item">
                <div class="img">
                    <img src="http://wpblog.local/wp-content/uploads/2022/02/left-img.jpg" alt="A girl and a boy are walking!">
                    <div class="layout">
                        <i class="far fa-plus-square"></i>
                    </div>
                </div>
                <div class="info">
                    <h4>Plan Your Trip</h4>
                    <a href="#">View Details<i class="fas fa-arrow-right"></i></a>
                </div>
            </div> -->
        </div>
    </div>
</section>
<!-- Feature Posts Section End -->

<!-- Category Choose Section Start -->
<section id="category_choose">
    <div class="container">
        <h2>
            <span class="dull">Tour</span>
            <span class="dark">Choose</span>
        </h2>
        <div class="row">
            <?php
            $categories = get_categories(
                [
                    'post_type' => 'post',
                    'post_status' => 'publish'
                ]
            );

            // echo "<pre>";term_id
            // print_r($categories);

            foreach($categories as $cat){
                ?>
                <a href="<?php echo get_category_link( $cat->term_id )?>">
                    <i class="fas fa-th-large"></i>
                    <h4><?php echo $cat->name; ?></h4>
                    <span>View route<i class="fas fa-arrow-right"></i></span>
                </a>
                <?php
            }
            ?>
        </div>
    </div>
</section>
<!-- Category Choose Section End -->


<!--Intrest_post section start-->  
<section id="intrest_post">
    <div class="container">
        <h2>
            <span class="dull">TRIPS BY</span>
            <span class="dark">INTERESTS</span>
        </h2>
        <div class="row"> 
            <?php
                $args2 = array(  
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'posts_per_page' => 6, 
                    'orderby' => 'date', 
                    'order' => 'DESC', 
                );
            
                $interests_posts_loop = new WP_Query( $args2 ); 
                if($interests_posts_loop->have_posts()){
                    while($interests_posts_loop->have_posts()){
                        $interests_posts_loop->the_post();
                        ?>

                            <div class="card">
                            <a href="<?php echo get_the_permalink(); ?>">
                                <div class="img">
                                    <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', TRUE); ?>">
                                    <div class="layout">
                                        <i class="far fa-plus-square"></i>
                                    </div>
                                </div>
                            </a>
                                <div class="info">
                                    <h4><?php echo get_the_title(); ?></h4>
                                    <div class="response">
                                        <span class="comment">
                                        <?php
                                            $args = array(
                                                'post_id' => get_the_ID(),
                                                'count'   => true
                                            );
                                            $comments_count = get_comments($args);
                                            echo $comments_count;
                                        ?>
                                        comments
                                        </span>
                                        <span class="views"><?= gt_get_post_view() == '' ? "0 views" : gt_get_post_view() . " views"  ?></span>
                                        <span class="like"><?php echo do_shortcode('[posts_like_dislike]');?></span>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                }
            ?>
        </div>
    </div>
</section>
<!--Intrest_post section End-->

<?php get_footer(); ?>