<?php
get_header();
?>
   <style>
		.header-desktop,.header-mobile{
			display: none !important;
		}
    </style>
    <div class="error_404_page">
        <section class="section sec_error">
            <div class="container">
                <div class="content">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12 wow fadeInUp">
                            <div class="notfound_404">
                                <div class="logo_content">
                                    <div class="page_404_logo">
                                        <img src="<?php echo DF_IMAGE."/logo.png" ;?>" alt="img logo" class="page_logo_img">
                                    </div>
                                </div>
                                <div class="page_404_content wow fadeInUp">
                                    <h2 class="h2_404">Page not found</h2>
                                    <h4 class="h4_404">Sorry, we couldn't find the page you were looking for.
                                    We suggest that you return to main page</br>
                                </div>
                            <a href="<?php echo home_url(); ?>" class="back-to-home wow fadeInUp" data-wow-delay="0.5s">Go to home page</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="page_image wow tada">
                                <img src="<?php echo DF_IMAGE."/404.png" ;?>" alt="img" class="page_404_img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <style>
        body{
			overflow: hidden !important;
		}
        .error_404_page{padding: calc(100vh - 75vh) 0; background-color: #282828;}
		.notfound_404{
			margin-left: 40px;
		}
		.sec_error{
			margin-bottom: 400px !important;
		}
		.page_404_img{
			width: 100%;
			object-fit: cover;
		} 
        .logo_content{display: flex; margin-bottom: 45px;}
        .page_404_logo{
            border-radius: 50%;
            /* background-color: #525252; */
            width: 59px;
            height: 59px;
            margin-right: 16px;
        }
        .page_404_logo img{width:100%; height: 59px;}
        .h1_404{
            color: #fff;
            font-size: 40px;
            font-weight: 700;
            line-height: 48px;
            text-align: left;
            margin-bottom: 0;
            padding-top: 10px;
        }
        .h2_404{
            color: #fff;
            font-size: 30px;
            line-height: 36px;
            font-weight: 700;
            text-align: left;
            margin-bottom: 20px;
        }
        .h4_404{
            color: #d0d0d0;
            font-size: 18px;
            line-height: 27px;
            max-width: 464px;
            width: 100%;
            font-weight: 300;
            text-align: left;
            margin-bottom: 40px;
        }
        .back-to-home{
            border: 1px solid #D8D8D8;
            border-radius: 2px;
            width: 189px;
            height: 52px;
            padding: 17px 40px;
            color: #d0d0d0;
            font-size: 14px;
            font-weight: 300;
            line-height: 17px;
            text-align: center;
        }
        @media screen and (max-width:991px){
            .content {
                padding-top: 60px;
            }
            .h4_404{
                max-width:none;
            }
            .page_404_img{
                margin-bottom: 40px;
            }
        }
    </style>

    <style>
        footer{
            display: none;
        }
    </style>
<?php
get_footer();






