<?php
get_header();
global $post;
?>
<style>
    .common-header .header-desktop--content-header--col-right--main-nav-menu ul li:nth-child(4) a,
    .common-footer .footer .main-footer .footer--col-left ul li:nth-child(4) a{
        font-family: Poppins-Bold;
        font-weight: 300 !important;
    }
</style>
<main class="single-blog" id="single-blog">
    <section class="single-blog--main">
        <div class="container">
            <!-- Beadcrumb -->
            <div class="content-beadcrum wow fadeIn">
                <?php echo get_the_breadcrumbs('ul','breadcrumbs','breadcrumbs','hrActive');?>
            </div>
            <h2 class="single-blog--main--title-h2"><?php echo $post->post_title;?></h2>
            <div class="row">
                <div class="col-ld-9 col-md-9 col-sm-12 col-12">
                    <?php
                        if($sec_post_deafault_content = get_field('post_default_content')):
                            foreach($sec_post_deafault_content as $key=>$value):
                                $secType = $value['acf_fc_layout'];
                                if($secType == 'Sec_content_1'):
                                    $sec_content_1 = $value;
                                    ?>
                                        <div class="col-left--cont-img">
                                            <img src="<?php echo $sec_content_1['image_big']?$sec_content_1['image_big']['url']:DF_IMAGE."/noimage.png";?>" alt="image-big-single-blog" />
                                        </div>
                                    <?php
                                endif;
                                if($secType == 'Sec_content_2'):
                                    $sec_content_2 = $value;
                                    ?>
                                        <div class="col-left--cont-text--description">
                                            <p><?php echo $sec_content_2['description']?$sec_content_2['description']:"";?></p>
                                        </div>
                                    <?php
                                endif;
                                if($secType == 'Sec_content_3'):
                                    $sec_content_3 = $value;
                                    ?>
                                        <div class="col-left--cont-text--description-two">
                                            <p><?php echo $sec_content_3['group_content']?$sec_content_3['group_content']['description']:"";?></p>
                                            <p><?php echo $sec_content_3['group_content']?$sec_content_3['group_content']['description_1']:"";?></p>
                                        </div>
                                    <?php
                                endif;
                                if($secType == 'Sec_content_4'):
                                    $sec_content_4 = $value;
                                    ?>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12 col-sm-12 col-12 col-margin">
                                                <div class="col-left--cont-text--description-column">
                                                    <p><?php echo $sec_content_4['group_content']?$sec_content_4['group_content']['description']:"";?></p>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-sm-12 col-12 col-margin">
                                                <div class="col-left--cont-text--description-column">
                                                    <p><?php echo $sec_content_4['group_content']?$sec_content_4['group_content']['description_1']:"";?></p>
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
                                            <div class="col-image">
                                                <img src="<?php echo $sec_content_5['group_content']['image']?$sec_content_5['group_content']['image']['url']:DF_IMAGE."/noimage.png";?>" alt="col-image">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-12 col-margin">
                                            <div class="col-left--cont-text--description-column">
                                                <p><?php echo $sec_content_5['group_content']?$sec_content_5['group_content']['description']:"";?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                endif;
                                if($secType == 'Sec_content_6'):
                                    $sec_content_6 = $value;
                                    ?>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-12 col-margin">
                                            <div class="col-left--cont-text--description-column">
                                                <p><?php echo $sec_content_6['group_content']?$sec_content_6['group_content']['description']:"";?></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-12 col-margin">
                                            <div class="col-image">
                                                <img src="<?php echo $sec_content_6['group_content']['image']?$sec_content_6['group_content']['image']['url']:DF_IMAGE."/noimage.png";?>" alt="col-image">
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                endif;
                                if($secType == 'Sec_content_7'):
                                    $sec_content_7 = $value;
                                    if($twoImage =  $sec_content_7['two_image']):?>
                                        <div class="row"><?php
                                        $count = count($twoImage);
                                            for ($i=0; $i < $count; $i++) { 
                                                $image = $twoImage[$i]?$twoImage[$i]['url']:DF_IMAGE."/noimage.png";
                                                echo '<div class ="col-lg-6 col-md-12 col-sm-12 col-12 col-margin"><div class="col-image"><img src="'.$image.'" alt="col-image" class="image'.$i.'"></div></div>';
                                            }?>
                                        </div>
                                    <?php endif;
                                endif;
                            endforeach;
                        endif;
                    ?>
                </div>
                <?php 
                    // var_dump($post->ID);
                    $args = array(
                        'post_type' => 'post',
                        'post__not_in' => array($post->ID),
                        'posts_per_page' => 3,
                        'orderby'=>'rand',//random
                    );
                if ($posts = get_posts($args)):?>
                    <div class="col-ld-3 col-md-3 col-sm-12 col-12">
                        <h4 class="single-blog--main--title-h4">you may also like</h4>
                        <?php                                    
                            foreach ($posts as $key=>$post):
                                ?>
                                <!-- <span style="color: white;"><?php //echo $post->ID; ?></span> -->
                                <div class="single-blog--main--col-right">
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