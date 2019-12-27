<?php
/* Template Name: Contact page */
$id = get_queried_object()->ID;
get_header();
?>
<main class="contact-page">
    <?php
        $contact_form = get_field('contact_form',$id);
        $Title = $contact_form['title']?$contact_form['title']:"Contact Us";
        $Description = $contact_form['description']?$contact_form['description']:"";
        $information = get_field('your_information','option');
        $phonenumber = $information['phone_number'];
        $address = $information['address'];
        $email = $information['email'];
    ?>
    <section class="contact-page--main">
        <div class="container">
            <!-- Beadcrumb -->
            <div class="content-beadcrum wow fadeIn">
                <?php echo get_the_breadcrumbs('ul','breadcrumbs','breadcrumbs','hrActive');?>
            </div>
        </div>
    </section>
    <div id="google-map">
        <?php
            $location = get_field('google_map');
            if( $location ): ?>
                <div class="acf-map" data-zoom="16">
                    <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
                </div>
            <?php endif; ?>
            <!-- KEY API Google Map -->
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCNkKNWgDN1BD-m6ny8ViSvOireBGRvjDQ"></script>
    </div>
    <div class="container">
        <div class="contact-page--main--contact-us">
            <h4 class="contact-us--title-h4 wow fadeInUp"><?php echo $Title;?></h4>
            <div class="contact-us--description wow fadeInUp" data-wow-delay="0.2s">
                <p><?php echo $Description;?></p>
            </div>
            <div class="contact-us--content-col-group">
                <div class="contact-us--cont-contact-form">
                        <?php echo do_shortcode('[contact-form-7 id="336" title="Contact Form Fundesign"]');?>
                </div>
                <div class="contact-us--information">
                    <?php if(!empty($address)):?>
                        <h4 class="contact-us--information--title-h4 wow fadeIn" data-wow-delay="0.3s">Address</h4>
                        <div class="contact-us--information--content-address wow fadeIn" data-wow-delay="0.31s" ><?php echo $address; ?></div>
                    <?php endif; ?>
                    <?php if(!empty($address)):?>
                        <h4 class="contact-us--information--title-h4 wow fadeIn" data-wow-delay="0.33s">Phone number</h4>
                        <div class="contact-us--information--content-phone wow fadeIn" data-wow-delay="0.34s">
                            <a href="tel:+<?php 
                                $delete = array(
                                ' ',
                                '(',
                                ')',
                                '+'
                                );
                                echo str_replace($delete,'',$phonenumber);?>">
                                <?php echo $phonenumber; ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($email)):?>
                        <h4 class="contact-us--information--title-h4 wow fadeIn" data-wow-delay="0.35s">Email</h4>
                        <div class="contact-us--information--content-email wow fadeIn" data-wow-delay="0.36s" ><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></div>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</main>
<?php get_footer();