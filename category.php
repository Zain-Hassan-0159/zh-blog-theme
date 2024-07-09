<?php get_header(); ?>
<div id="single_post" class="content container">
    <main>
        <div style="display: flex; flex-wrap:wrap;">
    <?php
    $category = get_queried_object();
    $args = array( 'posts_per_page' => -1,  'category' => $category->term_id );
    $bgimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 
    $myposts = get_posts( $args );
        foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
            <div style="margin: 10px; display:flex; flex-direction:column; width: 200px !important; text-align:center;">
            <img width="200" height="200" style="width: 200px !important;" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', TRUE); ?>">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </div>
        <?php endforeach; 
        wp_reset_postdata();
    
    ?>
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