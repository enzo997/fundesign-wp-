$=jQuery;let aurl=window.location.pathname;aurl=aurl.replace("/","");if(aurl!==''&&aurl!=='index.html')
$('header ul li a[href$="'+aurl+'"]').parent('li').addClass('active');else
$('header ul li:first-child').addClass('active');if(aurl!==''&&aurl!=='index.html')
$('header.menu-nav-show ul li a[href$="'+aurl+'"]').parent('li').addClass('active');else
$('header.menu-nav-show ul li:first-child').addClass('active');if(aurl!==''&&aurl!=='index.html')
$('footer ul li a[href$="'+aurl+'"]').parent('li').addClass('active');else
$('footer ul li:first-child').addClass('active');if(aurl==='single-work.html')
$('header ul li:nth-child(2)').addClass('active');if(aurl==='single-blog.html')
$('header ul li:nth-child(4)').addClass('active');$(function(){$('.home-page--banner-top--cont-slider-image').slick({dots:true,arrows:false,autoplay:true,speed:1300,infinite:true,slidesToShow:1,slidesToScroll:1,});$('.home-page--partner-logo .row').slick({dots:true,arrows:false,autoplay:false,speed:1300,infinite:true,slidesToShow:4,slidesToScroll:1,responsive:[{breakpoint:575,settings:{slidesToShow:2,slidesToScroll:1,}}]});$('.header-mobile .btn-bar').click(function(){$(this).toggleClass('active-menu-show'),$('.header-desktop').toggleClass('menu-nav-show'),$('.background-full-black').toggleClass('show-background-full-screen'),$('body').toggleClass('no-Scroll');});$(window).resize(function(){if($(window).height()<420)
$('.header-desktop').addClass('overlow-y-scroll');if($(window).height()>420)
$('.header-desktop').removeClass('overlow-y-scroll');});$(document).ready(function(){$(window).scroll(function(event){let top=$('html,body').scrollTop();if(top>100)
$('.button-bottom-scroll').addClass('show-btn-scroll');else
$('.button-bottom-scroll').removeClass('show-btn-scroll');});$('.button-bottom-scroll').click(function(event){$('html,body').animate({scrollTop:0},1300);});});});