jQuery(document).ready(function($) {
    //click button sort work
    $('.main-nav-menu-work--field').click(cat_button_ajax);
    //click button sort news
    $('.main-nav-menu-blog--field').click(cat_post_button_ajax);
    //Click load more Ajax work
    $('.load-more-ajax').click(load_more_ajax);
    $('.load-more-ajax-blog').click(load_more_ajax_blog);
});
//============== Work ==============//
function cat_button_ajax(){
    $('.main-nav-menu-work--field').removeClass('active');
    $(this).addClass('active');
    var data_term = $(this).attr('data-term'),
        data_page = jQuery('.load-more-ajax').attr('data_page');
        data_limit = jQuery('.load-more-ajax').attr('data_limit');
    $.ajax({
        type : "post",
        url : ajaxUrl,
        // url :ajax_var.url,
        data : {
            action: "fill_by_cat",
            data_term: data_term,
            data_limit: data_limit,
            data_page: data_page,
        },
        beforeSend: function(){
        },
        success: function(response) {
            $('.work-page .work-page--main--cont-group--category-image .row').html(response);
        },
        error: function( jqXHR, textStatus, errorThrown ){
            console.log( 'The following error occured: ' + textStatus, errorThrown );
        }
    });
}


//============== Load More AJAX ==============//
var blogLoading = false;
function load_more_ajax(){
    if(blogLoading == false){
        blogLoading = true;
        let input = jQuery('.load-more-ajax'),
        data_page = input.attr('data_page'),
        data_limit = input.attr('data_limit'),
        data_term = jQuery('.main-nav-menu-work--field.active').attr('data-term');
        $.ajax({
            type : "post",
            url : ajaxUrl,
            // url :ajax_var.url,
            data : {
                action: "loading_work",
                data_page: data_page,
                data_limit: data_limit,
                data_term: data_term,
            },
            beforeSend: function(){
                // Có thể thực hiện công việc load hình ảnh quay quay trước khi đổ dữ liệu ra
        },
        success: function(response) {
                //Làm gì đó khi dữ liệu đã được xử lý
                $('.work-page--main--cont-group--category-image .row').append(response);
                $('.blog-page .blog-page--box-content-blog .row').append(response);
        },
        complete: function() {
            blogLoading = false;
        },
        error: function( jqXHR, textStatus, errorThrown ){
                //Làm gì đó khi có lỗi xảy ra
                console.log( 'The following error occured: ' + textStatus, errorThrown );
        }
        });
    }
}

//============== Blog (Post Default)==============//
function cat_post_button_ajax(){
    $('.main-nav-menu-blog--field').removeClass('active');
    $(this).addClass('active');
    var data_cat = $(this).attr('data-term-post'),
        data_page = jQuery('.load-more-ajax-blog').attr('data-page');
        data_limit = jQuery('.load-more-ajax-blog').attr('data-limit');

    $.ajax({
        type : "post",
        url : ajaxUrl,
        // url :ajax_var.url,
        data : {
            action: "fill_by_cat_blog",
            data_cat : data_cat,
            data_limit: data_limit,
            data_page: data_page,
        },
        beforeSend: function(){
        },
        success: function(response) {
            $('.blog-page .blog-page--box-content-blog .row').html(response);
        },
        error: function( jqXHR, textStatus, errorThrown ){
            console.log( 'The following error occured: ' + textStatus, errorThrown );
        }
    });
}
//
var blogLoading_1= false;
function load_more_ajax_blog(){
    if(blogLoading_1 == false){
        blogLoading_1 = true;
        let input = jQuery('.load-more-ajax-blog'),
        data_page = input.attr('data-page'),
        data_limit = input.attr('data-limit'),
        data_cat = jQuery('.main-nav-menu-blog--field.active').attr('data-term-post');

        $.ajax({
            type : "post",
            url : ajaxUrl,
            // url :ajax_var.url,
            data : {
                action: "loading_blog",
                data_page: data_page,
                data_limit: data_limit,
                data_cat: data_cat,
            },
            beforeSend: function(){
                // Có thể thực hiện công việc load hình ảnh quay quay trước khi đổ dữ liệu ra
        },
        success: function(response) {
                //Làm gì đó khi dữ liệu đã được xử lý
                $('.blog-page .blog-page--box-content-blog .row').append(response);

        },
        complete: function() {
            blogLoading_1 = false;
        },
        error: function( jqXHR, textStatus, errorThrown ){
                //Làm gì đó khi có lỗi xảy ra
                console.log( 'The following error occured: ' + textStatus, errorThrown );
        }
        });
    }

}