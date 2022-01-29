<?php
//$genesis_theme_setting_mk = get_option('genesis_boilerplate');
//$header_defoult_img = $genesis_theme_setting_mk['general_banner_image'];
//global $header_defoult_img;


remove_action('genesis_loop', 'genesis_do_loop');
//add_action('genesis_before_content', 'include_page');

/* function include_page() {

  $page_id = genesis_get_custom_field('includepage');
  $page_data = get_page(get_the_ID());
  $title = $page_data->post_title;
  $content = apply_filters('the_content', $page_data->post_content);
  } */

//add_action('genesis_after_header', 'include_page');

function include_page() {
    ?>

    <div class="inner_header_image">
        <div class="main_heading_inner">

            <h1>Blog</h1>

        </div>  
    </div>

<?php
}

// add a custom loop
add_action('genesis_loop', 'my_custom_loop');

function my_custom_loop() {

    global $paged;

    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    $query_args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'orderby' => 'date',
        'posts_per_page' => 5,
        'paged' => $paged
    );

    $the_query = new WP_Query($query_args);
    ?>
    <?php global $post; ?>
    <ul>
        <?php if ($the_query->have_posts()) : ?>

            <!-- the loop -->
                        <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                <li>
                    <article class="row">
                        <div class="cntnt_cs right_cs">
                            <?php
                            $service_featured_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
                            if ($service_featured_image) {
                                $home_image_src = bfi_thumb($service_featured_image['0'], array(
                                    'width' => 800,
                                    'height' => 350,
                                    'crop' => true
                                ));
                                ?>

                                <div class="feature_cs">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><img src="<?php echo $home_image_src; ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>">
                                    </a>
                                </div>            

            <?php } ?>         
                            <div class="date_news">
                                <span class="date1"><?= get_the_date("j") ?></span>
                                <span class="date2"><?= get_the_date("M") ?></span>
                                <span class="date3"><?= get_the_date("Y") ?></span>
                            </div>

                            <div class="containt_news">
                                <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
            <?php
            $categories = get_the_category($post->ID);
            // print_r($categories);
            ?>
                                <!--                    <div class="category">
                                                        Posted in:
                                                        <span><?php
                    // $n=0; foreach($categories as $categorie){
                    // $link = get_category_link($categorie->term_id);
                    // echo "<a href='$link'>".$categorie->name."</a>";
                    // echo ($n % 2 >= sizeof($categories)-1) ? "" : ",";
                    //   $n++;
                    //  }
                    ?></span>
                            
                                                    </div>-->
                                <div class="content">
            <?= substr(get_the_excerpt(), 0, -10) ?>
                                </div>
                                <div class="readmore_cs">
                                    <a href="<?= the_permalink() ?>">Read More </a>
                                </div>
                            </div>
                        </div>
                    </article>
                </li>
            <?php endwhile; ?>
        <?php
        wp_reset_query();
        ?>
            <?php
            wp_pagenavi(); //if (function_exists("pagination")) {
            //pagination($the_query->max_num_pages);
            //} 
            ?> 


    <?php else: ?>
            <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
    <?php endif; ?>
    </ul>
<?php
}

add_action('genesis_after_content', 'do_sidebar_news_abc');

function do_sidebar_news_abc() {


    $args = array('post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => '5', 'orderby' => 'ID', 'order' => 'DESC');
    $service_package_list = new WP_Query($args);
    ?>

    <div class="totalbloghome">
        <h4>Latest News</h4>
        <ul>
    <?php
    while ($service_package_list->have_posts()) : $service_package_list->the_post();
        //$service_featured_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
        ?>
                <li class="totalblog">
                    <div class="blogcontent">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo get_the_title(); ?>
                        </a>
                    </div>	

                </li>
    <?php endwhile; ?>
        </ul>
    </div>
    <?php
}

remove_action('genesis_sidebar', 'genesis_do_sidebar');
remove_action('genesis_sidebar_alt', 'genesis_do_sidebar_alt');
genesis();
?>

