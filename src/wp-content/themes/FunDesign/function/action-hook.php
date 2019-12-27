<?php
//============================= GET POST FUNCTION =============================//
//================== Get work article ==================//
function get_work_article($thisPost){
    $id = $thisPost->ID;
    $title = $thisPost->post_title;
    $image = get_the_post_thumbnail_url($id)?get_the_post_thumbnail_url($id):DF_IMAGE. '/noimage.png';
    $link = get_permalink($id);
    ?>
    <div class="category-image--col-content">
        <!-- <span style="color: white;"><?php //echo $id; ?></span> -->
        <div class="category-image--col-content--cont-image-category ">
            <a href="<?php echo $link; ?>" title="<?php echo $title; ?>">
                <img src="<?php echo $image;?>" alt="image-work-page" />
            </a>
        </div>
    </div>
    <?php
}
//========= Get Blog (post Deafault) article ==========//
function get_Blog_article($thisPost){
    $id = $thisPost->ID;
    $title = $thisPost->post_title;
    $image = get_the_post_thumbnail_url($id)?get_the_post_thumbnail_url($id):DF_IMAGE. '/noimage.png';
    $link = get_permalink($id);
    $excerpt = $thisPost->post_excerpt;
    //$excerpt_custom_field = get_field('description_single')?get_field('description_single'):get_field('description_single_1');
    ?>
    <div class="cont-box">
        <!-- <span style="color: white;"><?php //echo $id; ?></span> -->
        <div class="content-blog--cont-image">
            <a href="<?php echo $link; ?>" title="<?php echo $title; ?>">
                <img src="<?php echo $image;?>" alt="image-Blog-page" />
            </a>
        </div>
        <div class="content-blog--cont-text">
            <h5 class="content-blog--cont-text--title-h5">
                <a href="<?php echo $link; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a>
            </h5>
            <div class="content-blog--cont-text--description">
            <?php 
                if($excerpt){
                    ?>
                        <p><?php echo $excerpt;?></p>
                    <?php
                }
                else{
                    if($sec_post_deafault_content = get_field('post_default_content')){
                        foreach($sec_post_deafault_content as $key=>$value):
                            $secType = $value['acf_fc_layout'];
                            if($secType == 'Sec_content_2'):
                                $sec_content_2 = $value;
                                $excerpt_custom = $sec_content_2['description']?$sec_content_2['description']:"";
                                ?>
                                    <p><?php echo $excerpt_custom;?></p>
                                <?php
                            endif;
                        endforeach;
                    }
                }
            ?>
            </div>
        </div>
    </div>
    <?php
}
//============================= END GET POST FUNCTION =============================//

//-----------------------------------------------------------------------------------------------------------------------------------------------------//

//================================ AJAX WORK =================================//
//================== AJAX  Fill WORK ==================//
add_action( 'wp_ajax_fill_by_cat', 'fill_by_cat_work' );
add_action( 'wp_ajax_nopriv_fill_by_cat', 'fill_by_cat_work' );
function fill_by_cat_work(){
    $data_term = $_POST['data_term'];
    $data_limit = $_POST['data_limit'];//common data
    $args = array(
        'post_type'=> 'our-work',
        'orderby'    => 'date',
        'post_status' => 'publish',
        'posts_per_page' => $data_limit,
        'order'    => 'DESC',
        'tax_query' => array( 
            array(
                'taxonomy' => 'categories-our-work',
                'field' => 'term_id',
                'terms' => $data_term
            )
        )
    );
    $posts = get_posts($args);
    if($posts){
        foreach($posts as$key=> $post){
            ?>
            <div class="col-lg-4 col-md-4 col-sm-12 col-12 wow fadeInUp" data-wow-duration="1.5s"  data-wow-delay="<?php echo ($key!==0)?($key/$data_limit).'s':""; ?>" >
            <?php
                get_work_article($post);
            ?>
            </div>
            <?php
        }
        // Load more get data form loading_work Function
        $count_load = count(get_posts($args));
        $args['posts_per_page'] = -1;
        $total = count(get_posts($args));
        ?>
        <script>
            let input = jQuery('.work-page .load-more-ajax');
            input.attr('data_page', '2');
            if(<?php echo ($count_load ); ?> >= <?php echo $total; ?>)
                input.hide();
            else
                input.show();
        </script>
        <?php
    }else{
        echo 'Not found';
    }
    exit;
}
//================ AJAX Load More Work ===============//
add_action( 'wp_ajax_loading_work', 'loading_work' );
add_action( 'wp_ajax_nopriv_loading_work', 'loading_work' );
function loading_work(){
    $data_page = $_POST['data_page'];
    $data_limit = $_POST['data_limit'];//common data
    $data_term = $_POST['data_term'];
    $offset = ( $data_limit * $data_page ) - $data_limit;
    $args = array(
        'post_type'=> 'our-work',
        'orderby'    => 'date',
        'post_status' => 'publish',
        "posts_per_page" => $data_limit ,
        'order'    => 'DESC',
        'offset'   => $offset,
    );
    if($data_term != 'all'){
        $args['tax_query'] = array( 
            array(
                'taxonomy' => 'categories-our-work',
                'field' => 'term_id',
                'terms' => $data_term,
            )
        );
    }
    $Number_of_post_work = get_posts($args);//Number of posts                 
    if($Number_of_post_work){
        foreach($Number_of_post_work as $key=>$post){     
            ?>
                <div class="col-lg-4 col-md-4 col-sm-12 col-12 wow fadeInUp" data-wow-duration="1.5s"  data-wow-delay="<?php echo ($key!==0)?($key/$data_limit).'s':""; ?>">
                    <?php get_work_article($post); ?>
                </div>
            <?php
        }
    }
    $count_load = count($Number_of_post_work);
    $args['posts_per_page'] = -1;
    $total = count(get_posts($args));// post of Total at Current pages
    ?>
    <script>
        let input = jQuery('.work-page .load-more-ajax');
        input.attr('data_page', <?php echo ($data_page+1); ?>);
        if(<?php echo ($count_load + $offset); ?> >= <?php echo $total; ?>)
            input.hide();
        else
            input.show();
    </script>
    <?php
    exit;
}
//============================== END AJAX WORK ===============================//

//-----------------------------------------------------------------------------------------------------------------------------------------------------//

///============================AJAX BLOG ============================//

//****************** AJAX Blog (cat of posts deafault) **************//
add_action( 'wp_ajax_fill_by_cat_blog', 'fill_by_cat_blog' );
add_action( 'wp_ajax_nopriv_fill_by_cat_blog', 'fill_by_cat_blog' );
function fill_by_cat_blog(){
    $data_cat = $_POST['data_cat'];
    $data_limit = $_POST['data_limit'];//common data
    $args = array(
        'post_type'      => 'post',
        'orderby'        => 'date',
        'post_status'    => 'publish',
        "posts_per_page" =>   $data_limit,
        'order'          => 'DESC'
    );
    if($data_cat != 'all'){
        $args['tax_query'] = [
            [
                'taxonomy' => 'category',
                'field'    => 'term_id',
                'terms'    =>  $data_cat 
            ]
        ];
    }

    $posts = get_posts($args);

    if($posts){
        foreach($posts as $key=>$post){
            ?>
            <div class="col-lg-4 col-md-4 col-sm-12 col-12 wow fadeInUp" data-wow-duration="1.5s"  data-wow-delay="<?php echo ($key!==0)?($key/$data_limit).'s':""; ?>">
            <?php
                get_Blog_article($post);
            ?>
            </div>
            <?php
        // Load more get data form loading_work Function
        $count_load = count($posts);
        $args['posts_per_page'] = -1;
        $total = count(get_posts($args));
        ?>
        <script>
            let input = jQuery('.blog-page .load-more-ajax-blog');
            input.attr('data-page', '2');
            if(<?php echo ($count_load); ?> >= <?php echo $total; ?>)
                input.hide();
            else
                input.show();
        </script>
        <?php
        }
    }else{
        echo 'Not found';
    }
    exit;
}
//================ AJAX Load More Blog ===============//
add_action( 'wp_ajax_loading_blog', 'loading_blog' );
add_action( 'wp_ajax_nopriv_loading_blog', 'loading_blog' );
function loading_blog(){
    $data_page = $_POST['data_page'];
    $data_limit = $_POST['data_limit'];//common data
    $data_cat = $_POST['data_cat'];
    $offset = ( $data_limit * $data_page ) - $data_limit;
    $args = array(
        'post_type'=> 'post',
        'orderby'    => 'date',
        'post_status' => 'publish',
        "posts_per_page" => $data_limit,
        'order'    => 'DESC',
        'offset'   => $offset,
    );
    if($data_cat != 'all'){
        $args['tax_query'] = [
            [
                'taxonomy' => 'category',
                'field'    => 'term_id',
                'terms'    =>  $data_cat 
            ]
        ];
    }
    $posts = get_posts($args);//Number of posts                 
    if($posts){
        foreach($posts as $key=>$post){     
            ?>
                <div class="col-lg-4 col-md-4 col-sm-12 col-12 wow fadeInUp" data-wow-duration="1.5s"  data-wow-delay="<?php echo ($key!==0)?($key/$data_limit).'s':""; ?>">
                    <?php get_Blog_article($post); ?>
                </div>
            <?php
        }
    }
    $count_load = count($posts);
    $args['posts_per_page'] = -1;
    $total = count(get_posts($args));// post of Total at Current pages
    ?>
    <script>
        let input = jQuery('.load-more-ajax-blog');
        input.attr('data-page', <?php echo ($data_page + 1); ?>);
        if(<?php echo ($count_load + $offset); ?> >= <?php echo $total; ?>)
            input.hide();
        else
            input.show();
    </script>
    <?php
    exit;
}
///============================ END AJAX BLOG ============================//

