<?php
/* Template Name: About page */
$id = get_queried_object()->ID;
get_header();
?>
<main class="about-page">
    <section class="about-page--main">
        <div class="container">
            <!-- Beadcrumb -->
            <div class="content-beadcrum wow fadeIn">
                <?php echo get_the_breadcrumbs('ul','breadcrumbs','breadcrumbs','hrActive');?>
            </div>
            <?php
            $Description = get_field('text_group_top',$id)['text_col_left']['description'];
            $Description_1 = get_field('text_group_top',$id)['text_col_right']['description'];
            if(!empty($Description)&&!empty($Description)):?>
                <div class="about-page--main--content-text-banner-top  wow fadeInUp" data-wow-duration="1.5s">
                    <div class="row">
                        <?php 
                        if(!empty($Description)): ?>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12 ">
                                <div class="cont-col-left">
                                    <h4 class="cont-col-left--title-h4 wow fadeInUp" data-wow-duration="1.2s"><?php echo get_field('text_group_top',$id)['text_col_left']['title']?get_field('text_group_top',$id)['text_col_left']['title']:"Our target"?></h4>
                                    <div class="cont-col-left--description wow fadeInUp" data-wow-duration="1.6s" data-wow-delay="0.2s">
                                        <p><?php  echo $Description;?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endif;?>
                        <?php 
                        if(!empty($Description_1)): ?>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="cont-col-right">
                                <h4 class="cont-col-right--title-h4 wow fadeInUp" data-wow-duration="1.2s"><?php echo get_field('text_group_top',$id)['text_col_right']['title']?get_field('text_group_top',$id)['text_col_right']['title']:"Timeline"?></h4>
                                <div class="cont-col-right--description wow fadeInUp" data-wow-duration="1.6s" data-wow-delay="0.3s">
                                    <p><?php  echo $Description_1;?></p>
                                </div>
                            </div>
                        </div>
                        <?php endif;?>
                    </div>
                </div>
            <?php endif;?>
            <div class="row">
                <?php
                    $row_image = get_field('row_image',$id);
                foreach($row_image as $i=>$item){
                    $i++;
                    $image = $item['image']?$item['image']['url']:DF_IMAGE. '/noimage.png';?>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-12 wow fadeIn"data-wow-delay="0.2s">
                        <div class="about-page--main--cont-image wow fadeInUp" data-wow-duration="1.6s"  data-wow-delay="<?php echo ($i!==1)?($i/6).'s':""; ?>"><img src="<?php echo $image;?>" alt="image-about" /></div>
                </div>
                <?php
                }
                ?>
            </div>
            <?php
            $title = get_field('text_group_bottom',$id)['title']?get_field('text_group_bottom',$id)['title']:"We're Hiring";
            $Description_3 = get_field('text_group_bottom',$id)['description'];
            if(!empty($Description_3)):?>
                <div class="about-page--main--content-text  wow fadeInUp" data-wow-duration="1.5s">
                    <h4 class="about-page--main--content-text--title-h4 wow fadeInUp" data-wow-duration="1.2s"><?php echo $title?></h4>
                    <div class="about-page--main--content-text--description wow fadeInUp" data-wow-duration="1.2s" data-wow-delay='0.2s'>
                        <p><?php echo $Description_3;?></p>
                </div>
            <?php endif;?>
        </div>
    </section>
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