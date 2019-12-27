<?php
get_header();
global $post;
?>
<main class="single-work" id="single-work">
    <section class="single-work--top">
        <div class="container">
            <div class="single-work--top--breadcrumb"><a href="<?php echo get_home_url(); ?>"  class="wow fadeInUp">Home </a><b  class="wow fadeInUp">/ </b><a href="<?php echo get_hr_link('work');?>"  class="wow fadeInUp"><b class="name">Work</b></a> <b  class="wow fadeInUp">/ </b><b class="name wow fadeInUp" style="font-family:poppins-Bold;"><?php echo $post->post_title?></b></div>
            <h4 class="single-work--top--title-h4 wow fadeInUp"><?php echo $post->post_title?></h4>
            <div class="single-work--top--description  wow fadeInUp" data-wow-delay = "0.4s">
                <p><?php echo get_field('banner_top_single_work')['description']?get_field('banner_top_single_work')['description']:"";?></p>
            </div>
            <div class="single-work--top--cont-image-banner-top wow fadeInUp" data-wow-delay = "0.5s"><img src="<?php echo get_field('banner_top_single_work')['banner_image']?get_field('banner_top_single_work')['banner_image']['url']:DF_IMAGE."/noimage.png";?>" alt="image-banner-top" /></div>
            <div class="single-work--top--description-under-image-top wow fadeInUp" data-wow-delay = "1s" data-wow-duration="1.5s">
                <p><?php echo get_field('body_single_work')['description']?get_field('body_single_work')['description']:"";?></p>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md--6 col-sm-12 col-12 wow fadeInLeft" data-wow-delay = "0.5s" data-wow-duration="2s">
                    <div class="single-work--top--cont-iamge-under-description ">
                        <img src="<?php echo get_field('body_single_work')['group_image']['image_left']?get_field('body_single_work')['group_image']['image_left']['url']:DF_IMAGE."/noimage.png";?>" alt="image-single" />
                    </div>
                </div>
                <div class="col-lg-6 col-md--6 col-sm-12 col-12 wow fadeInRight" data-wow-delay = "0.5s" data-wow-duration="2s">
                    <div class="single-work--top--cont-iamge-under-description">
                        <img src="<?php echo get_field('body_single_work')['group_image']['image_right']?get_field('body_single_work')['group_image']['image_right']['url']:DF_IMAGE."/noimage.png";?>" alt="image-single" />
                    </div>
                </div>
            </div>
            <div class="single-work--top--finnal-description wow fadeInLeft" data-duration ="1.5s" data-wow-delay = "0.5s" >
                <p><?php echo get_field('description_leg');?></p>
            </div>
            <div class="single-work--top--finnal-cont-image wow fadeInRight" data-duration ="1.5s"><img src="<?php echo get_field('image_leg')?get_field('image_leg')['url']:DF_IMAGE."/noimage.png";?>" alt="image-banner" /></div>
        </div>
    </section>
    <?php 
        // var_dump($post->ID);
        $args = array(
            'post_type' => 'our-work',
            'post__not_in' => array($post->ID),
            'posts_per_page' => 3,
            'orderby'=>'date',
            'order'=>'DESC',
        );
    if ($posts = get_posts($args)):?>
        <section class="single-work--view-similar-Work ">
            <div class="container">
                <h4 class="single-work--view-similar-Work--title-h4 wow fadeInUp" data-wow-duration="1.2s"><?php echo get_field('view_similar_work')?get_field('view_similar_work')['title']:"View Similar Work";?></h4>
                <div class="single-work--view-similar-Work--description wow fadeInUp" data-wow-duration="1.2s" data-wow-delay="0.4s">
                    <p><?php echo get_field('view_similar_work')?get_field('view_similar_work')['description']:"";?></p>
                </div>
                <div class="row">
                    <?php                                         
                        foreach ($posts as $key=>$post):
                            ?>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-12 wow fadeInUp" data-wow-duration="1.5s"  data-wow-delay="<?php echo ($key!==0)?($key/7).'s':""; ?>">
                                    <!-- <span style="color: white;"><?php //echo $post->ID; ?></span> -->
                                    <div class="single-work--view-similar-Work--cont-image">
                                        <a href="<?php echo get_permalink($post->ID); ?>"title="<?php echo $post->post_title; ?>">
                                            <img src="<?php echo get_the_post_thumbnail_url($post->ID)?get_the_post_thumbnail_url($post->ID):DF_IMAGE.'/noimage.png';?>" alt="image-single-similar">
                                        </a>
                                    </div>
                                </div>
                            <?php
                        endforeach;
                    ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
</main>
<?php
get_footer();