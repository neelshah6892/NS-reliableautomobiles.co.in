<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
remove_action('genesis_entry_header', 'genesis_entry_header_markup_open', 5);
remove_action('genesis_entry_header', 'genesis_entry_header_markup_close', 15);
remove_action('genesis_entry_header', 'genesis_post_info', 12);
remove_action('genesis_entry_footer', 'genesis_post_meta');
//remove_action('genesis_entry_header', 'genesis_do_post_title');
//* Run the Genesis loop
remove_action('genesis_loop', 'genesis_do_loop');
add_action('genesis_loop', 'my_custom_loop');
function my_custom_loop() {
    global $post;
    ?>
    <section class="main_content_area location_section">
        <div class="cntnt_cs right_cs">
            <?php
                if ( have_posts() ) : while ( have_posts() ) : the_post();
            ?>
            <div class="date_post">
                <span class="date1"><?= get_the_date("j") ?></span>
                <span class="date2"><?= get_the_date("M") ?></span>
                <span class="date3"><?= get_the_date("Y") ?></span>
            </div>
            <div class="containt_post">
                <div class="content"><?php the_content(); ?> </div>
            </div>
            <?php endwhile; endif; ?>
        </div>
    </section>
    <?php
}
remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
add_action('genesis_after_content','sidebar_area');
function sidebar_area(){
?>
<aside class="widget widget-area">
    <h3 class="widget-title">Recent Posts</h3>
    <div class="cms-recent-post">
        <div class="cms-recent-post-wrapper">
          <?php
           $args = array('post_type' => 'post', 'post_status' => 'publish','posts_per_page' => '5', 'orderby' => 'date', 'order' => 'DESC');
           $blog_list = new WP_Query($args);
            while ($blog_list->have_posts()) : $blog_list->the_post();
                $sidebar_post_title = get_the_title(); 
                $sidebar_post_title = (strlen($sidebar_post_title) > 28)?substr($sidebar_post_title,0,28)."...":$sidebar_post_title;
              
                $feat_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'thumbnail' );
                $image_url = $feat_image[0];
                if(empty($image_url))
                  $image_url = get_stylesheet_directory_uri()."/images/thumbnail-placeholder-blog.png";
              ?>
            <div class="widget-recent-item clearfix">
                <div class="image-thumbnail">
                    <a class="img" href="<?php the_permalink(); ?>"><img class="thumbnail-image" src="<?php echo $image_url; ?>" title="<?php echo ucfirst(strtolower(get_the_title())); ?>" alt="<?php echo ucfirst(strtolower(get_the_title())); ?>"></a>
                </div>
                <div class="image-main">
                    <h4><a href="<?php the_permalink(); ?>" title="<?php echo ucfirst(strtolower(get_the_title())); ?>"><?php  echo ucfirst(strtolower($sidebar_post_title)); ?></a></h4>
                    
                </div>
            </div>
          <?php endwhile ?>
        </div>
    </div>
</aside>
<?php
}
remove_action('genesis_sidebar', 'genesis_do_sidebar');
remove_action('genesis_sidebar_alt', 'genesis_do_sidebar_alt');
genesis();
?>
