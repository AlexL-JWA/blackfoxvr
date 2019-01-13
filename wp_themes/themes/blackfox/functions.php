<?php
add_theme_support('title-tag');
add_theme_support('post-thumbnails');
$marker = get_field('contact', 'options');
// var_dump($marker);
// die;

add_action('wp_print_styles', 'add_styles');
function add_styles() {
    wp_enqueue_style('main', get_template_directory_uri().'/css/main.css');
}

add_action('wp_enqueue_scripts', 'add_scripts');
function add_scripts() {
	$marker = get_field('contact', 'options');
    wp_deregister_script('jquery');
    wp_enqueue_script('build_js', get_template_directory_uri().'/js/build.js', '', '6.7', true);
	wp_enqueue_script('main_js', get_template_directory_uri().'/js/map.js', '', '', true);
	wp_localize_script( "main_js", "map_marker", array("map_marker"=>$marker['map_marker']));
	
	global  $wp_query;
	wp_enqueue_script('lazy_load', get_template_directory_uri().'/js/lazy_load.js', '', '', true);
	wp_localize_script ('lazy_load' , 'lazy_load' , array(
		'ajaxurl' => site_url ( ) . '/wp-admin/admin-ajax.php',
		'posts' => json_encode($wp_query -> query_vars),
		'current_page' =>  (get_query_var('paged')) ? get_query_var('paged') : 1,
		'max_page' => $wp_query -> max_num_pages,
		'posts_per_page'=> 4 
	)  ) ;
}

function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

add_action('init', 'my_custom_init');
function my_custom_init(){
	register_post_type('games', array(
		'labels'             => array(
			'name'               => 'Игры',
			'singular_name'      => 'Игра',
			'add_new'            => 'Добавить новую',
			'add_new_item'       => 'Добавить новую игру',
			'edit_item'          => 'Редактировать игру',
			'new_item'           => 'Новая книга',
			'view_item'          => 'Посмотреть игру',
			'search_items'       => 'Найти игру',
			'not_found'          => 'Игр не найдено',
			'not_found_in_trash' => 'В корзине игр не найдено',
			'parent_item_colon'  => '',
			'menu_name'          => 'Игры'

		  ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
        'menu_position'      => null,
        'taxonomies'         => array( 'category' ),
		'supports'           => array('title','editor','thumbnail')
	) );
}
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}

function new_excerpt_length($length) {
	return 15;
}
function trim_excerpt($text) {
	return rtrim($text,'[&hellip], [...]');
	}
	add_filter('get_the_excerpt', 'trim_excerpt');
add_filter('excerpt_length', 'new_excerpt_length');

function loadmore_ajax_handler(){
 
	query_posts( 'posts_per_page=-1');

	if( have_posts() ) :
		echo '<div class="blog-items">';
		while( have_posts() ): the_post();

			get_template_part( 'post-content', get_post_format() ); 
 
		endwhile;
		wp_reset_query();
		echo '</div>';
	endif;
	die; 

}

add_action('wp_ajax_loadmore', 'loadmore_ajax_handler');
add_action('wp_ajax_nopriv_loadmore', 'loadmore_ajax_handler');

add_action('after_setup_theme', function(){
	register_nav_menus( array(
		'header_menu' => 'Меню в шапке',
	) );
});