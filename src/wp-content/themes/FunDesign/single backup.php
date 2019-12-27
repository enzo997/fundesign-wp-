<?php
get_header();
global $post;
?>
<main class="single-blog" id="single-blog">
    <section class="single-blog--main">
        <div class="container">
            <div class="single-blog--main--breadcrumb">
                <!-- <a href="<?php//echo get_home_url(); ?>"  class="wow fadeInUp">Home </a><b  class="wow fadeInUp">/ </b><a href="<?php echo get_hr_link('blog');?>"  class="wow fadeInUp"><b class="name">Blogs</b></a> <b  class="wow fadeInUp">/ </b><b class="name wow fadeInUp" style="font-family:poppins-Bold;"><?php echo excerpt($post->post_title,5,'...');?></b> -->
                
            </div>
            <h2 class="single-blog--main--title-h2 wow fadeInUp" data-duration ="1.5s"><?php echo $post->post_title;?></h2>
            <div class="row">
                <div class="col-ld-9 col-md-9 col-sm-12 col-12">
                    <div class="single-blog--main--col-left">
                        <div class="col-left--cont-img wow fadeInLeft" data-duration ="1.7s"><img src="<?php echo get_field('banner_single')?get_field('banner_single')['url']:DF_IMAGE."/noimage.png";?>" alt="image-single-blog" /></div>
                        <?php
                            $des_p_1 = get_field('description_single');
                            $des_p_2 = get_field('description_single_1');
                        ?>
                        <div class="col-left--cont-text wow fadeIn" data-duration="4s">
                            <div class="col-left--cont-text--description">
                                <?php
                                if(!empty($des_p_1)):
                                ?>
                                    <p class="wow fadeInUp" data-duration ="1.5s" data-wow-delay="0.3s"><?php echo $des_p_1;?></p>
                                <?php
                                endif;
                                if(!empty($des_p_2)): ?>
                                    <p class="wow fadeInUp" data-duration ="1.5s"  data-wow-delay="0.4s"><?php echo $des_p_2;?></p>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                    <div class="single-blog--main--col-left">
                        <div class="col-left--cont-img wow fadeInLeft" data-duration ="1.7s"><img src="<?php echo get_field('mid_banner_single')?get_field('mid_banner_single')['url']:DF_IMAGE."/noimage.png";?>" alt="image-single-blog" /></div>
                        <div class="col-left--cont-text  wow fadeIn" data-duration="4s">
                            <div class="col-left--cont-text--description wow fadeInUp" data-duration ="1.5s" data-wow-delay="0.2s">
                                <p><?php echo get_field('description_singgle_3')?get_field('description_singgle_3'):"";?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                    // var_dump($post->ID);
                    $args = array(
                        'post_type' => 'post',
                        'post__not_in' => array($post->ID),
                        'posts_per_page' => 3,
                        'orderby'=>'date',
                        'order'=>'DESC',
                    );
                if ($posts = get_posts($args)):?>
                    <div class="col-ld-3 col-md-3 col-sm-12 col-12">
                        <h4 class="single-blog--main--title-h4 wow fadeInRight">you may also like</h4>
                        <?php                                    
                            foreach ($posts as $key=>$post):
                                ?>
                                <!-- <span style="color: white;"><?php //echo $post->ID; ?></span> -->
                                <div class="single-blog--main--col-right wow fadeInUp" data-duration ="1.7s" data-wow-delay="<?php echo ($key!==0)?($key/6).'s':""; ?>">
                                    <div class="col-right--cont-img">
                                        <a href="<?php echo get_permalink($post->ID); ?>" title="<?php echo $post->post_title ; ?>">
                                            <img src="<?php echo get_the_post_thumbnail_url($id)?get_the_post_thumbnail_url($id):DF_IMAGE. '/noimage.png';?>" alt="image-single-blog" />
                                        </a>
                                    </div>
                                    <div class="col-right--cont-text">
                                        <h4 class="col-right--cont-text--title-h4"><a href="<?php echo get_permalink($post->ID); ?>" title="<?php echo $post->post_title ; ?>"><?php echo excerpt($post->post_title,9,'...'); ?></a></h4>
                                    </div>
                                </div>
                                <?php
                            endforeach;
                        ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>
<?php
get_footer();