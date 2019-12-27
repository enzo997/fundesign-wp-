<?php
//===================== SET UP ACF CUSTOME POST TYPE======================//
function nt_create_post_type($args) {
    if(!is_array($args) || !$args['post_type'] || !$args['name'] || !$args['single'] || !$args['slug']) return;
    $post_type = $args['post_type'];
    $name = $args['name'];
    $single = $args['single'];
    $slug = $args['slug'];

    register_post_type($post_type, array(
        'labels' => array(
            'name' => __($name),
            'singular_name' => __($single),
            'add_new' => __('Add New '.$single),
            'add_new_item' => __('Add New '.$single),
            'edit_item' => __('Edit '.$single),
            'new_item' => __('New '.$single),
            'all_items' => __('All '.$name),
            'view_item' => __('View '.$single),
            'search_items' => __('Search '.$name),
            'not_found' => __('Not Found '.$single),
            'not_found_in_trash' => __('Not Found '.$single.' In Trash'),
            'parent_item_colon' => '',
            'menu_name' => __($name)
        ),
        'public' => true,
        'menu_icon'   => 'dashicons-star-half',// Add icon for custom post type
        'exclude_from_search' => false,
        'menu_position' => 6,
        'has_archive' => true,
        'taxonomies' => array($post_type),
        'rewrite' => array('slug' => $slug),
        'supports' => array('title', 'editor', 'excerpt', 'revisions', 'thumbnail', 'author')
    ));
}
function nt_create_taxonomy($args) {
    if(!is_array($args) || !$args['post_type'] || !$args['name'] || !$args['single'] || !$args['taxonomy'] || !$args['slug']) return;
    $post_type = $args['post_type'];
    $name = $args['name'];
    $single = $args['single'];
    $slug = $args['slug'];
    $taxonomy = $args['taxonomy'];

    $labels = array(
        'name' => __($name),
        'singular_name' => __($single),
        'search_items' => __('Search '.$name),
        'popular_items' => __('Popular '.$name),
        'all_items' => __('All '.$name),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __('Edit '.$single),
        'update_item' => __('Update '.$single),
        'add_new_item' => __('Add '.$single),
        'new_item_name' => __('New '.$single),
        'menu_name' => __($name),
    );
    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => $slug),
    );
    register_taxonomy($taxonomy, $post_type, $args);
}
//=========== ADD Custom post type and taxaonomy ===========//
function create_new_custom_post_type_and_taxonomy(){
    //=== Add post type our work ===//
    $args = array(
        "post_type" => 'our-work',
        "name" => "Our Work",
        "single" => "Our Work",
        "slug" => "our-work"
    );
    nt_create_post_type($args);
    //=== Add taxaonomy our work ===//
    $args = array(
        "post_type" => array('our-work'),
        "name" => "Categories Our Work",
        "single" => "categories-our-work",
        "slug" => "categories-our-work",
        "taxonomy" => "categories-our-work"
    );
    nt_create_taxonomy($args);
}
add_action('init', 'create_new_custom_post_type_and_taxonomy');


//=========== Add custom image size ===========//
add_filter('intermediate_image_sizes_advanced', 'hero_remove_default_image_sizes');
function hero_remove_default_image_sizes( $sizes) {
	unset( $sizes['thumbnail']);
	unset( $sizes['medium']);
	unset( $sizes['large']);
	unset( $sizes['medium_large']);
	return $sizes;
}
add_action( 'after_setup_theme', 'pp_setup' );
function pp_setup() {
    load_theme_textdomain( 'pp' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'logo-partner', 140, 34, true);
    // add_image_size( 'thumb-530x369', 530, 369, true);
    // add_image_size( 'thumb-561x374', 561, 374, true);
    // add_image_size( 'thumb-400x268', 400, 268, true);
    // add_image_size( 'thumb-636x424', 636, 424, true);
}


//=========== upload svg or svgz ===========//
function my_custom_mime_types( $mimes ) {
    
    // New allowed mime types.
    $mimes['svg'] = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'my_custom_mime_types' );

//=============== Add file post-thumbnails ===========//
add_theme_support( 'post-thumbnails' );

//===================get link by slug ================//
function get_hr_link($name){
    if($link = get_permalink( get_page_by_path( $name ) ))
        return $link;
    return '#';
}
//==================== Limit Character ==============//
function excerpt($content, $limit="50", $more='…') {
    $excerpt = explode(' ', $content, $limit);
    
    if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(' ',$excerpt).$more;
    } else {
        $excerpt = implode(' ',$excerpt);
    }
    $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
    return $excerpt;
}
//===============get_breadcrumb ==================//
function get_the_breadcrumbs ( $list_style = 'ol', $list_id = 'breadcrumb', $list_class = 'breadcrumb', $active_class = 'active', $echo = false ) {
	// Get text domain for translations
	$theme = wp_get_theme();
	$text_domain =  $theme->get( 'Fun Design showcase' );

	// Open list
	$breadcrumb = '<' . $list_style . ' id="' . $list_id . '" class="' . $list_class . '" z-index:9999; bottom:100px">';
	// Front page
	if ( is_front_page() ) {
		$breadcrumb .= '<li class="' . $active_class . '">Home</li>';
	} else {
		$breadcrumb .= '<li><a href="' . home_url() . '">Home</a></li>';
	}
	
	// Blog archive
	if ( 'page' == get_option( 'show_on_front' ) && get_option( 'page_for_posts' ) ) {
		$blog_page_id = get_option( 'page_for_posts' );
		if ( is_home() ) {
			$breadcrumb .= '<li class="' . $active_class . '">' . get_the_title( $blog_page_id )  . '</li>';
		} else if ( is_category() || is_tag() || is_author() || is_date() || is_singular( 'post' ) ) {
			$breadcrumb .= '<li><a href="' . get_permalink( $blog_page_id ) . '">' . get_the_title( $blog_page_id )  . '</a></li>';
		}
	}
	
	// Category, tag, author and date archives
	if ( is_archive() && ! is_tax() && ! is_post_type_archive() ) {
		$breadcrumb .= '<li class="' . $active_class . '">';
		
		// Title of archive
		if ( is_category() ) {
			$breadcrumb .= single_cat_title( '', false );
		} else if ( is_tag() ) {
			$breadcrumb .= single_tag_title( '', false );
		} else if ( is_author() ) {
			$breadcrumb .= get_the_author();
		} else if ( is_date() ) {
			if ( is_day() ) {
				$breadcrumb .= get_the_time( 'F j, Y' );
			} else if ( is_month() ) {
				$breadcrumb .= get_the_time( 'F, Y' );
			} else if ( is_year() ) {
				$breadcrumb .= get_the_time( 'Y' );
			}
		}
		$breadcrumb .= '</li>';		
	}
	
	// Posts
	if ( is_singular( 'post' ) ) {
		$mypage = get_post(18);/////===================> DINAMIC ID PAGE POST http://localhost/wp-admin/post.php?post=18&action=edit
		$breadcrumb .= '<li><a href="' . get_permalink($mypage->ID) . '">' . $mypage->post_title . '</a></li>';
		$post_cats = get_the_category();
		$breadcrumb .= '<li class="' . $active_class . '">' . get_the_title() . '</li>';
	}
	// Pages
	if ( is_page() && ! is_front_page() ) {
		$post = get_post( get_the_ID() );
		// Page parents
		if ( $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$crumbs = array();
			while ( $parent_id ) {
				$page = get_page( $parent_id );
				$crumbs[] = '<a href="' . get_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a>';
				$parent_id  = $page->post_parent;
			}
			$crumbs = array_reverse( $crumbs );
			foreach ( $crumbs as $crumb ) {
				$breadcrumb .= '<li>' . $crumb . '</li>';
			}
		}
		// Page title
		$breadcrumb .=  '<li class="' . $active_class . '">' . get_the_title() . '</li>';
	}	
	// Attachments
	if ( is_attachment() ) {
		// Attachment parent
		$post = get_post( get_the_ID() );
		if ( $post->post_parent ) {
			$breadcrumb .= '<li><a href="' . get_permalink( $post->post_parent ) . '">' . get_the_title( $post->post_parent ) . '</a></li>';
		}
		// Attachment title
		$breadcrumb .= '<li class="' . $active_class . '">' . get_the_title() . '</li>';
	}
	// Search
	if ( is_search() ) {
		$breadcrumb .= '<li class="' . $active_class . '">' . __( 'Search', $text_domain ) . '</li>';
	}
	// 404
	if ( is_404() ) {
		$breadcrumb .= '<li class="' . $active_class . '">' . __( '404', $text_domain ) . '</li>';
	}
	// Custom Post Type Archive
	if ( is_post_type_archive() ) {
		$breadcrumb .= '<li class="' . $active_class . '">' . post_type_archive_title( '', false ) . '</li>';
	}
	// Custom Taxonomies
	if ( is_tax() ) {
		// Get the post types the taxonomy is attached to
		$current_term = get_queried_object();
		$attached_to = array();
		$post_types = get_post_types();
		foreach ( $post_types as $post_type ) {
			$taxonomies = get_object_taxonomies( $post_type );
			if ( in_array( $current_term->taxonomy, $taxonomies ) ) {
				$attached_to[] = $post_type;
			}
		}
		// Term title
		$breadcrumb .= '<li class="' . $active_class . '">' . single_term_title( '', false ) . '</li>';
	}
	// Custom Post Types
	if ( is_single() && get_post_type() != 'post' && get_post_type() != 'attachment' ) {
		$cpt_obj = get_post_type_object( get_post_type() );
		// Is cpt hierarchical like pages or posts?
        $mypage='';
		if(get_post_type()=='our-work'){
            $mypage = get_post(14);// ID PAGE ======> DINAMIC http://localhost/wp-admin/post.php?post=14&action=edit
		}
		
		$breadcrumb .= '<li><a href="' . get_permalink($mypage->ID) . '">' . $mypage->post_title . '</a></li>';
		if ( is_post_type_hierarchical( $cpt_obj->name ) ) {
			// Cpt parents
			$post = get_post( get_the_ID() );
			if ( $post->post_parent ) {
				$parent_id  = $post->post_parent;
				$crumbs = array();
				while ( $parent_id ) {
					$page = get_page( $parent_id );
					$crumbs[] = '<a href="' . get_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a>';
					$parent_id  = $page->post_parent;
				}
				$crumbs = array_reverse( $crumbs );
				foreach ( $crumbs as $crumb ) {
					$breadcrumb .= '<li>' . $crumb . '</li>';
				}
			}
		} else {
			// Get cpt taxonomies
			$cpt_taxes = get_object_taxonomies( $cpt_obj->name );

			if ( $cpt_taxes && is_taxonomy_hierarchical( $cpt_taxes[0] ) ) {
				// Other taxes attached to the cpt could be hierachical, so need to look into that.
				
				$cpt_terms = get_the_terms( get_the_ID(), $cpt_taxes[0] );
				if ( is_array( $cpt_terms ) ) {
					$output = false;
					foreach( $cpt_terms as $cpt_term ) {
						
						if ( ! $output ) {
							// $breadcrumb .= '<li><a href="' . get_term_link( $cpt_term->name, $cpt_taxes[0] ) . '">' . $cpt_term->name . '</a></li>';
							$output = true;
						}
					}
				}
			}
		}
		// Cpt title
		$breadcrumb .= '<li class="' . $active_class . '">' . get_the_title() . '</li>';
	}
	// Close list
	$breadcrumb .= '</' . $list_style . '>';
	// Ouput
	if ( $echo ) {
		echo $breadcrumb;
	} else {
		return $breadcrumb;
	}
}

// remove  remove_post_type_support editor and add plugin classic Editor
add_action( 'init', function() {
	remove_post_type_support( 'page', 'editor' );	
    remove_post_type_support( 'post', 'editor' );
    remove_post_type_support( 'our-work', 'editor' );
}, 99);









