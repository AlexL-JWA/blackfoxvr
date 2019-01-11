<?php
add_theme_support('title-tag');
add_theme_support('post-thumbnails');

add_action('wp_print_styles', 'add_styles');
function add_styles() {
    wp_enqueue_style('main', get_template_directory_uri().'/css/main.css');
}

add_action('wp_enqueue_scripts', 'add_scripts');
function add_scripts() {
    wp_deregister_script('jquery');
    wp_enqueue_script('build_js', get_template_directory_uri().'/js/build.js', '', '6.7', true);
    wp_enqueue_script('main_js', get_template_directory_uri().'/js/map.js', '', '', true);
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