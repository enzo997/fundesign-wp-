<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <script type="text/javascript" src="https://www.bugherd.com/sidebarv2.js?apikey=grlxqwotmnlvbbfposrspg" async="true"></script> -->
    <?php wp_head(); ?>
</head>
<script>
var ajaxUrl = "<?php echo admin_url('admin-ajax.php')?>";
console.log(ajaxUrl);
</script>
<body <?php body_class(); ?> >
<div id="page"><!-- begin id page -->
    <div class="common-header">
        <header class="header-mobile" id="header">
            <div class="container">
                <div class="header-mobile--content-header">
                    <div class="header-mobile--content-header-cont-logo"> 
                        <a href="<?php echo get_home_url(); ?>">
                            <img src="<?php echo get_field('logo_for_header_and_footer','option')?get_field('logo_for_header_and_footer','option')['url']:DF_IMAGE. '/logo.png';?>" alt="image-logo" />
                        </a>
                    </div>
                    <div class="header-mobile--content-header--cont-menu-bar">
                        <div class="btn-bar">
                            <div class="icon-menu"></div>
                            <div class="close-icon-menu"></div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <header class="header-desktop" id="header">
            <div class="container">
                <div class="header-desktop--content-header">
                    <div class="header-desktop--content-header--col-left">
                        <div class="header-desktop--content-header--col-left--cont-logo">  
                            <a href="<?php echo get_home_url(); ?>">
                                <img src="<?php echo get_field('logo_for_header_and_footer','option')?get_field('logo_for_header_and_footer','option')['url']:DF_IMAGE. '/logo.png';?>" alt="image-logo" />
                            </a>
                        </div>
                    </div>
                    <div class="header-desktop--content-header--col-right">
                        <div class="header-desktop--content-header--col-right--main-nav-menu">
                            <?php 
                                wp_nav_menu( 
                                    array( 
                                        'theme_location' => 'header_menu', 
                                        'menu_class' => 'main-nav-menu'
                                    ) 
                                );
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="background-full-black"></div>
        </header>
    </div>

