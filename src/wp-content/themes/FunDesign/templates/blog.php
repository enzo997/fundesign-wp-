<?php
/* Template Name: Blog page */
$id = get_queried_object()->ID;
get_header();
$array  = array(
    'post_type' => 'post',
    'orderby' => 'date',
    'order' => 'DESC',
    'posts_per_page' => -1
);
$lang_total_posts = new WP_Query($array);
$total_posts = $lang_total_posts->posts;
?>
 <main class="blog-page">
    <section class="blog-page--main">
        <div class="container">
            <!-- Beadcrumb -->
            <div class="content-beadcrum wow fadeIn">
                <?php echo get_the_breadcrumbs('ul','breadcrumbs','breadcrumbs','hrActive');?>
            </div>
            <div class="blog-page--nav-menu-blog">
                <ul>
                    <li class="main-nav-menu-blog--field active wow fadeIn" data-term-post = "all" >All</a></li>
                    <?php 
                    $args = array(
                        'hide_empty' => false,
                        'orderby'    => "ID",
                        'order'      => 'ASC'
                    );
                    $terms = get_terms('category', $args); 
                    if($terms){
                        foreach($terms as $term){
                            echo '<li class="main-nav-menu-blog--field wow fadeIn " data-term-post ="'.$term->term_id.'">'.$term->name.'</li>';
                        }
                    }
                    ?>
                </ul>
            </div>
            <?php
            $limit = 12;
            $paged =  get_query_var('paged')?get_query_var('paged'):1;
            $args = array(
                'post_type'=> 'post',
                'orderby'    => 'date',
                'post_status' => 'publish',
                "posts_per_page" => $limit,
                'order'    => 'DESC',
                "paged"=>$paged,
            );
            if(isset($_POST['data-term-post'])){
                $args['tax_query'] = array( 
                    array(
                        'taxonomy' => 'category',
                        'field' => 'term_id',
                        'terms' => $_POST['data-term-post'],
                    )
                );
            }
            $lang_posts = new WP_Query($args);
            $posts = $lang_posts->posts;
            ?>
            <div class="blog-page--box-content-blog">
                <div class="row">
                    <?php
                        foreach($posts as $key=> $post){
                            ?>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-12 wow fadeInUp" data-wow-duration="1.5s"  data-wow-delay="<?php echo ($key!==0)?($key/$limit).'s':""; ?>">
                                    <?php get_Blog_article($post);?>
                                </div>
                            <?php
                        };
                    ?>
                </div>
                <button class="load-more-ajax-blog" data-page="2" data-limit="<?php echo $limit; ?>" <?php if (count($total_posts) <= 12) : echo ' style="display: none;"'; endif; ?>>Load more</button>
            </div>
        </div>
    </section>
</main>
<?php get_footer();