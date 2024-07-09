<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ZH-Blog
 */

get_header(); 

global $post;
// echo "<pre>";
// print_r($post);
$author_id = $post->post_author;
$post_id = $post->ID;
 // Get options
 $options = get_option( 'zh_blog' ); // unique id of the framework
?>
<div id="single_post" class="content container">
    <main>
        <article>
            <div class="article-img">
                <img src="./images/post-12-copyright.jpg" alt="">
            </div>
            <div class="post-info">
                <span class="post-date item"><?php echo get_the_date( 'F j, Y' ); ?></span>
                <span class="views item"><?= gt_get_post_view() == '' ? "0 views" : gt_get_post_view() . " views"  ?></span>
                <?php echo do_shortcode('[posts_like_dislike]');?>
                <a href="#comment_form"  class="comments item">
                    <?php
                        $args = array(
                            'post_id' => $post_id,
                            'count'   => true
                        );
                        $comments_count = get_comments( $args );
                       echo $comments_count;
                    ?>
                    comments
                </a>
            </div>
            <div class="post-description">
            <?php
            if(have_posts()){
                while(have_posts()){
                    the_post();
                    the_content();
                    gt_set_post_view();
                }
            }
            ?>
                <div class="post-meta">
                    <div class="post-tags">
                        <?php
                            $post_tags = get_the_tags();
    
                            if ( $post_tags ) {
                                foreach( $post_tags as $tag ) {
                                ?>
                                <a href="<?php echo get_tag_link( $tag->term_id ) ?>" class="social-icon"><?php echo $tag->name ?></a>
                                <?php
                                }
                            }
                        ?>
                    </div>
                    <div class="social-icons">
                        <a href="<?php echo $options['twitter-link']['url']; ?>" class="twitter social-icon "><i class="fab fa-twitter"></i></a>
                        <a href="<?php echo $options['face-book-link']['url']; ?>" class="facebook social-icon"><i class="fab fa-facebook-f"></i></a>
                    </div>
                </div>
            </div>
            <div class="author-info">
                <div class="author-img">
                    <img src="https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?f=y" alt="">
                </div>
                <div class="author-intro">
                    <h3 class="author-name"><?php
                    echo get_the_author_meta('display_name', $author_id)?></h3>
                    <p class="about">
                        <?php echo get_the_author_meta( 'description', $author_id ) ?>
                    </p>
                    <a href="<?php echo get_the_author_meta( 'user_url', $author_id ) ?>">Read More</a>
                </div>                     
        </article>
        <div class="more-info">
        <?php
        $next_post = get_adjacent_post(false, '', false);
        $prev_post = get_adjacent_post(false, '', true);
        if(!empty($prev_post)) {
            ?>
            <a href="<?php echo get_permalink($prev_post->ID) ?>">
                <h6><i class="fas fa-arrow-left"></i>  
                    <?php echo  $prev_post->post_title; ?>     
                </h6>
            </a>
            <?php 
        }
        if(!empty($next_post)) {
            ?>
            <a href="<?php echo get_permalink($next_post->ID) ?>">
                <h6><?php echo  $next_post->post_title; ?> 
                    <i class="fas fa-arrow-right"></i>      
                </h6>
            </a>
            <?php 
        }
         ?>
    </div>  
        <div id="comment_form" class="comment-form">
            <div class="heading">Leave a Comment</div>
            <?php comment_form(); ?>
        </div>
    </main>
    <aside>
        <div class="category-widget">
            <h3>Categoris</h3>
            <ul>
                <?php
                    $categories = get_categories( array(
                        'type' => get_post_type(),
                        'orderby' => 'name',
                        'order'   => 'ASC'
                    ) );

                    foreach( $categories as $category ) {
                        ?>
                        <li><a href="<?php echo get_category_link($category->term_id); ?>"><?php echo $category->name; ?></a><i class="fas fa-arrow-right"></i></li>
                        <?php  
                    } 
                ?>
            </ul>
        </div>
        <div class="search-widget">

            <form action="/" method="get">
                <input type="search" name="s" id="search" value="<?php the_search_query(); ?>" placeholder="Search...">
                <i class="fas fa-search"></i>
            </form>
            
        </div>
        <div class="tags-widget">
            <h3>Tags</h3>
            <div class="post-tags">
                <?php
                    $args = array(
                        'type' => get_post_type(),
                        'orderby' => 'name',
                        'order' => 'ASC'
                    );
                    $tags = get_tags($args);

                    foreach($tags as $tag) { 
                    ?>
                        <a href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo $tag->name ?></a>
                    <?php
                    }
                ?>
            </div>
        </div>
    </aside>
</div>
<?php get_footer(); ?>