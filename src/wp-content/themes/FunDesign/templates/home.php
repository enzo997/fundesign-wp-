<?php
/* Template Name: Home page */
$id = get_queried_object()->ID;
get_header();
?>
<main class="home-page">
    <!-- section banner top -->
    <section class="home-page--banner-top">
        <div class="container">
            <?php $Banner_top = get_field('banner_top',$id);?>
            <div class="home-page--banner-top--content">
                <h1 class="home-page--banner-top--content--title-h1 wow fadeInUp" data-wow-duration="1.5s">
                    <?php echo $Banner_top['cont_title_discription']?$Banner_top['cont_title_discription']['title']:"Hi !" ;?>
                </h1>
                <div class="home-page--banner-top--content--description wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.1s">
                    <p><?php echo $Banner_top['cont_title_discription']?$Banner_top['cont_title_discription']['description']:"" ;?></p>
                </div>
            </div>
            <div class="home-page--banner-top--cont-slider-image">
                <?php
                    $slider_image = $Banner_top['slider_image'];
                    // var_dump($slider_image);
                    if($slider_image){
                        foreach($slider_image as $i=> $item):
                            $i++;
                            $image = $item['image']?$item['image']['url']:DF_IMAGE. '/noimage.png';
                            ?>
                                <div class="cont-slider-image--silder-image wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.2s">
                                    <div class="slider-image"><img src="<?php echo $image; ?>" alt="image-silder" /></div>
                                </div>
                            <?php
                        endforeach;
                    }else{
                        ?>
                            <div class="cont-slider-image--silder-image wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.2s">
                                <div class="slider-image"><img src="<?php echo DF_IMAGE. '/noimage.png'; ?>" alt="image-silder" /></div>
                            </div>
                        <?php
                    }
                    
                ?>
            </div>
        </div>
        <div class="home-page--banner--top--background-behind"></div>
    </section>
    <!-- section our work -->
    <?php 
        $our_work = get_field('our_work',$id);
        $args = array(
            'post_type'   => 'our-work',
            'parent'      => get_query_var('cat'),
            'orderby'     => 'ID',
            'order'       => 'ASC',
            'post_status' => 'publish',
            'number'      => 5
        );
        $terms = get_terms('categories-our-work', $args);
    if(!empty($terms)): ?>
        <section class="home-page--our-work">
            <div class="container">
                <h4 class="home-page--our-work--title-h4  wow fadeInUp" data-wow-duration="1.5s"><?php echo $our_work['title']?$our_work['title']:"Our Work";?></h4>
                <div class="our-work--description wow fadeInUp" data-wow-duration="1.5s"  data-wow-delay="0.4s">
                    <p><?php echo $our_work['description']?$our_work['description']:""; ?></p>
                </div>
                <div class="our-work--cont-group">
                    <div class="our-work--cont-group--background-behind"></div>
                    <div class="our-work--cont-group--category-image">
                        <div class="row">
                            <?php foreach($terms as $key=> $term): ?>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                    <div class="category-image--col-content-<?php echo $key;?> wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="<?php echo ($key!==0)?($key/7).'s':""; ?>">
                                        <div class="category-image--col-content--cont-image-category">
                                            <form action="<?php echo get_hr_link('work');?>" method="post">
                                                <a title="<?php echo $term->name?>">
                                                    <input type="submit" value="">
                                                    <img src="<?php echo get_field('thumbnail_our_work',$term)? get_field('thumbnail_our_work',$term)['url']:DF_IMAGE. '/noimage'; ?>" alt="image-our-work" />
                                                </a>
                                            </from>
                                        </div>
                                        <div class="category-image--col-content--title-category">
                                            <form action="<?php echo get_hr_link('work');?>" method="post">
                                                <input type="hidden" name ="data-term" value="<?php echo $term->term_id?>">
                                                <input type="submit" value="<?php echo $term->name; ?>">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif;?>
    <!-- section people are saying -->
    <?php 
        $People_are_saying = get_field('what_people_are_saying',$id);
        $title = $People_are_saying['title'];
        $People_description = $People_are_saying['description']?$People_are_saying['description']:""
    ?>
    <?php if(!empty($title)): ?>
        <section class="home-page--people-saying">
            <div class="container">
                <h4 class="home-page--people-saying--title-h4 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.1s"><?php echo $title;?></h4>
                <div class="home-page--people-saying--description wow fadeInUp" data-wow-duration="1.5s"  data-wow-delay="0.4s">
                    <p><?php echo $People_description;?></p>
                </div>
                <div class="row">
                    <?php 
                        $content_group_people = $People_are_saying['content_group_people'];
                        foreach($content_group_people as $i=> $item){
                            $i++;
                            $content_box = $item['content_box'];
                            ?>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                    <div class="people-saying--cont-group">
                                        <div class="people-saying--cont-group--cont-image wow fadeInUp" data-wow-duration="1.5s"  data-wow-delay="<?php echo ($i!==1)?($i/5).'s':""; ?>"><img src="<?php echo $content_box['imgage']?$content_box['imgage']['url']:DF_IMAGE. '/noimage.png' ;?>" alt="image-people-saying" /></div>
                                        <div class="people-saying--cont-group--cont-text">
                                            <div class="people-saying--cont-group--cont-text--name wow fadeInUp" data-wow-duration="1.5s"  data-wow-delay="<?php echo ($i!==1)?($i/5).'s':""; ?>"><?php echo $content_box['name']?$content_box['name']:"Name";?></div>
                                            <div class="people-saying--cont-group--cont-text--job-position wow fadeInUp" data-wow-duration="1.5s"  data-wow-delay="<?php echo ($i!==1)?($i/5).'s':""; ?>"><?php echo $content_box['position']?$content_box['position']:"Position";?></div>
                                            <div class="people-saying--cont-group--cont-text--description wow fadeInUp" data-wow-duration="1.5s"  data-wow-delay="<?php echo ($i!==1)?($i/5).'s':""; ?>">
                                                <p><?php echo $content_box['description']?$content_box['description']:"";?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        }
                    ?>
                </div>
            </div>
        </section>
    <?php endif;?>
    <!-- section blog -->
    <?php 
        $Show_post= get_field('blog', $id)['the_post_you_want_to_show_or_automatic'];
        if($Show_post['select_or_default'] == 0){
            $args = array(
                'orderby'          => 'date',
                'post_status'      => 'publish',
                'posts_per_page'   => 3,
                'order'            => 'DESC',
                'suppress_filters' => false,
            );
            $lang_posts = new WP_Query($args);
            $posts = $lang_posts->posts;
        } else{
            $posts = $Show_post['the_post_you_want_to_show'];
        }  
    if(!empty($posts)):?>
        <section class="home-page--Blog">
            <div class="container">
                <h4 class="home-page--Blog--title-h4"><?php echo get_field('blog',$id)?get_field('blog',$id)['title']:"Blog" ;?></h4>
                <div class="home-page--Blog--description">
                    <p><?php  echo get_field('blog',$id)?get_field('blog',$id)['description']:"" ;?></p>
                </div>
                <div class="row">
                    <?php 
                        foreach($posts as $key => $post){
                            ?>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                    <div class="Blog--group-content wow fadeInUp" data-wow-duration="1.5s"  data-wow-delay="<?php echo ($key!==0)?($key/5).'s':""; ?>">
                                        <div class="Blog--group-content--cont-image">
                                            <a href="<?php echo get_permalink($post->ID); ?>"title="<?php echo $post->post_title; ?>">
                                                <img src="<?php echo get_the_post_thumbnail_url($post->ID)?get_the_post_thumbnail_url($post->ID):DF_IMAGE.'/noimage.png';?>" alt="image-post">
                                            </a>
                                        </div>
                                        <div class="Blog--group-content--box-description">
                                            <a href="<?php echo get_permalink($post->ID); ?>" title="<?php echo $post->post_title; ?>"><p><?php echo excerpt($post->post_title,11,'...'); ?></p></a>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        };
                    ?>
                </div>
            </div>
        </section>
    <?php endif;?>
    <!-- section partner logo -->
    <?php $Logo_partner = get_field('logo_partner','option');
    if(!empty($Logo_partner)):?>
        <section class="partner-logo">
            <div class="container">
                <div class="row">
                    <?php
                        foreach($Logo_partner as $i => $item){
                            $i++;
                            $image = $item['image']?$item['image']['sizes']['logo-partner']:DF_IMAGE. "/noimage.png";
                            ?>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                    <div class="partner-logo--cont-image wow fadeIn" data-wow-duration="1.5s"  data-wow-delay="<?php echo ($i!==1)?($i/4).'s':""; ?>">
                                        <img src="<?php echo $image; ?>" alt="logo-partner" />
                                    </div>
                                </div>
                            <?php 
                        };
                    ?>
                </div>
            </div>
        </section>
    <?php endif;?>
</main>
<?php get_footer();