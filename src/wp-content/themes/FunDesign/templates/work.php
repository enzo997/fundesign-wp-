<?php
/* Template Name: Work page */
$id = get_queried_object()->ID;
get_header();
$array  = array(
    'post_type' => 'our-work',
    'orderby' => 'date',
    'order' => 'DESC',
    'posts_per_page' => -1
);
$lang_total_posts = new WP_Query($array);
$total_posts = $lang_total_posts->posts;
if(isset($_POST['data-term'])){
    $cate_work = $_POST['data-term']?$_POST['data-term']:0;
}
else{
    $cate_work = '';
}
?>
<main class="work-page">
    <section class="work-page--top">
        <div class="container">
            <!-- Beadcrumb -->
            <div class="content-beadcrum wow fadeIn">
                <?php echo get_the_breadcrumbs('ul','breadcrumbs','breadcrumbs','hrActive');?>
            </div>
            <div class="work-page--top--nav-menu-work">
                <ul>
                    <?php if ($cate_work == 0) : ?>
                        <li class=" all-current main-nav-menu-work--field active wow fadeIn" data-term = "all">All</li>
                    <?php else : ?>
                        <li class=" all-current main-nav-menu-work--field wow fadeIn" data-term = "all">All</li>
                    <?php endif; ?>
                    <?php 
                    $args = array(
                        'hide_empty' => false,
                        'orderby'    => "ID",
                        'order'      => 'ASC'
                    );
                    $terms = get_terms('categories-our-work', $args); 
                    if($terms){
                        foreach($terms as $term){
                            if ($term->term_id == $cate_work) {
                                echo '<li class="main-nav-menu-work--field active wow fadeIn" data-term="'.$term->term_id.'">'.$term->name.'</li>';
                            } else {
                                echo '<li class="main-nav-menu-work--field wow fadeIn" data-term="'.$term->term_id.'">'.$term->name.'</li>';
                            }
                            
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </section>
    <?php
        $limit = 12;
        $paged =  get_query_var('paged')?get_query_var('paged'):1;
        $args = array(
            'post_type'=> 'our-work',
            'orderby'    => 'date',
            'post_status' => 'publish',
            "posts_per_page" => $limit ,
            'order'    => 'DESC',
            "paged"=>$paged,
        );
        if(isset($_POST['data-term'])){
            $args['tax_query'] = array( 
                array(
                    'taxonomy' => 'categories-our-work',
                    'field' => 'term_id',
                    'terms' => $_POST['data-term'],
                )
            );
        }
        $lang_posts = new WP_Query($args);
        $posts = $lang_posts->posts;
    ?>
    <section class="work-page--main">
        <div class="container">
            <div class="work-page--main--cont-group">
                <div class="work-page--main--cont-group--background-behind"></div>
                <div class="work-page--main--cont-group--category-image">
                    <div class="row">
                        <?php
                            foreach($posts as $key=> $post){
                                ?>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-12 wow fadeInUp" data-wow-duration="1.5s"  data-wow-delay="<?php echo ($key!==0)?($key/12).'s':""; ?>">
                                        <?php get_work_article($post); ?>
                                    </div>
                                <?php
                            };
                        ?>
                    </div>
                    <button class="load-more-ajax" data_page="2" data_limit="<?php echo $limit; ?>"<?php if (count($total_posts) <= 12) : echo ' style="display: none;"'; endif; ?>>Load more</button>
                </div>
            </div>
        </div>
    </section>
</main>
<?php get_footer();