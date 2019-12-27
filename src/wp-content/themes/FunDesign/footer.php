
<div class="common-footer">
    <footer class="footer" id="footer">
        <div class="container">
            <div class="main-footer">
                <div class="footer--col-left">
                    <?php 
                        wp_nav_menu( 
                            array( 
                                'theme_location' => 'header_menu', 
                                'menu_class' => 'main-nav-menu'
                            ) 
                        );
                    ?>
                </div>
                <div class="footer--col-right">
                    <div class="footer--col-right--cont-social-network">
                        <ul class="class-social-icon">
                            <?php
                                $Social_network = get_field('social_network','option');
                                foreach($Social_network as $i=>$item):
                                    $i++;
                                    $logo_icon = $item['image_icon']?$item['image_icon']['url']:DF_IMAGE. '/noimage.png';
                                    $link_icon = $item['social_link']?$item['social_link']:"#";
                                    ?>
                                    <li class = "cont-social-icon">
                                        <a href="<?php echo $link_icon;?>" target="_blank">
                                            <img src="<?php echo $logo_icon; ?>" alt="icon-social-network">
                                        </a>
                                    </li>
                                    <?php
                                endforeach;
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer--copyright">
                <div class="footer--copyright--col-left">
                    <div class="footer--copyright--col-left--cont-logo"><a href="<?php echo get_home_url(); ?>"><img src="<?php echo get_field('logo_for_header_and_footer','option')?get_field('logo_for_header_and_footer','option')['url']:DF_IMAGE. '/logo.png';?>" /></a></div>
                </div>
                <div class="footer--copyright--col-right">
                    <p>© Copyright 2019 | All Rights Reserved</p>
                </div>
            </div>
        </div>
    </footer>
    </div>
    <div class="button-bottom-scroll">
        <div class="container">
            <div class="btn-scroll-top"><i class="fa fas fa-chevron-right"></i></div>
        </div>
    </div>
</div>
<?php wp_footer(); ?>

</div><!-- end id page -->
</body>
</html>