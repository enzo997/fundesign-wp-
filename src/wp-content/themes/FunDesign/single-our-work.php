<?php
get_header();
global $post;
?>
<style>
    .common-header .header-desktop--content-header--col-right--main-nav-menu ul li:nth-child(2) a,
    .common-footer .footer .main-footer .footer--col-left ul li:nth-child(2) a{
        font-family: Poppins-Bold;
        font-weight: 300 !important;
    }
</style>
<main class="single-work" id="single-work">
    <section class="single-work--top">
        <div class="container">
            <!-- Beadcrumb -->
            <div class="content-beadcrum wow fadeIn">
                <?php echo get_the_breadcrumbs('ul','breadcrumbs','breadcrumbs','hrActive');?>
            </div>
            <h4 class="single-work--top--title-h4"><?php echo $post->post_title?></h4>
            <div class="single-work--top--description">
                <p><?php echo get_field('banner_top_single_work')['description']?get_field('banner_top_single_work')['description']:"";?></p>
            </div>
            <?php
                if($sec_post_content = get_field('post_content')):
                    // var_dump($sec_post_content);
                    foreach($sec_post_content as $key=>$value):
                        $secType = $value['acf_fc_layout'];
                        if($secType == 'Sec_content_1'):
                            $sec_content_1 = $value;
                            ?>
                                <div class="single-work--top--cont-image-banner-top"><img src="<?php echo $sec_content_1['image_big']?$sec_content_1['image_big']['url']:DF_IMAGE."/noimage.png";?>" alt="image-banner-big" /></div>
                            <?php
                        endif;
                        if($secType == 'Sec_content_2'):
                            $sec_content_2 = $value;
                            ?>
                                <div class="single-work--top--description-under-image-top">
                                    <p><?php echo $sec_content_2['description']?$sec_content_2['description']:"";?></p>
                                </div>
                            <?php
                        endif;
                        if($secType == 'Sec_content_3'):
                            $sec_content_3 = $value;
                            if($twoImage =  $sec_content_3['two_image']):?>
                                <div class="row"><?php
                                $count = count($twoImage);
                                    for ($i=0; $i < $count; $i++) { 
                                        $image = $twoImage[$i]?$twoImage[$i]['url']:DF_IMAGE."/noimage.png";
                                        echo '<div class ="col-lg-6 col-md--6 col-sm-12 col-12"><div class="col-image-single-work"><img src="'.$image.'" alt="col-image" class="image'.$i.'"></div></div>';
                                    }?>
                                </div>
                            <?php endif;
                        endif;
                        if($secType == 'Sec_content_4'):
                            $sec_content_4 = $value;
                            ?>
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12 col-12 col-margin">
                                    <div class="col-image">
                                        <img src="<?php echo $sec_content_4['group_content']['image']?$sec_content_4['group_content']['image']['url']:DF_IMAGE."/noimage.png";?>" alt="col-image">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-12 col-margin">
                                    <div class="col-left--cont-text--description-column">
                                        <p><?php echo $sec_content_4['group_content']?$sec_content_4['group_content']['description']:"";?></p>
                                    </div>
                                </div>
                            </div>
                            <?php
                        endif;
                        if($secType == 'Sec_content_5'):
                            $sec_content_5 = $value;
                            ?>
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12 col-12 col-margin">
                                    <div class="col-left--cont-text--description-column">
                                        <p><?php echo $sec_content_5['group_content']?$sec_content_5['group_content']['description']:"";?></p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-12 col-margin">
                                    <div class="col-image">
                                        <img src="<?php echo $sec_content_5['group_content']['image']?$sec_content_5['group_content']['image']['url']:DF_IMAGE."/noimage.png";?>" alt="col-image">
                                    </div>
                                </div>
                            </div>
                            <?php
                        endif;
                    endforeach;
                endif;
            ?>
        </div>
    </section>
    <?php 
        // var_dump($post->ID);
        $args = array(
            'post_type' => 'our-work',
            'post__not_in' => array($post->ID),
            'posts_per_page' => 3,
            'orderby'=>'rand',//random
        );
    if ($posts = get_posts($args)):?>
        <section class="single-work--view-similar-Work ">
            <div class="container">
                <h4 class="single-work--view-similar-Work--title-h4"><?php echo get_field('view_similar_work')['title']?get_field('view_similar_work')['title']:"View Similar Work";?></h4>
                <div class="single-work--view-similar-Work--description">
                    <p><?php echo get_field('view_similar_work')?get_field('view_similar_work')['description']:"";?></p>
                </div>
                <div class="row">
                    <?php                                         
                        foreach ($posts as $key=>$post):
                            ?>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
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