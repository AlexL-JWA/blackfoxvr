<?php

/**
 * Plugin Name: VRBooking
 * Plugin URI: #
 * Description: Бронирование комнат. Специально для https://blackfoxvr.com/
 * Version: 1.0
 * Author: Cherednichenko Pavel
 * Author URI: https://t.me/PavelCherednichenko
 */
 
/* Тип поста */
define('VR_PTYPE', 'vrbooking');
define('VR_PROMOKOD', 'vrpromokod');

include_once(plugin_dir_url(__FILE__).'api/smsc_api.php');

/* Инициализация (регистрация типа поста, страницы в админке) */
add_action('init', 'vr_init');

function vr_init() {
	
	/* Регистрация типа поста */
	$labels = array(
	
		'name'               => _x('Бронирования', VR_PTYPE, 'vrbooking'),
		'singular_name'      => _x('Бронирование', VR_PTYPE, 'vrbooking'),
		'menu_name'          => _x('VR Бронирования', 'vrbooking', 'vrbooking'),
		'name_admin_bar'     => _x('Бронирование', 'vrbooking', 'vrbooking'),
		'add_new'            => _x('Добавить', 'vrbooking', 'vrbooking'),
		'add_new_item'       => __('Добавить бронирование', 'vrbooking'),
		'new_item'           => __('Добавить', 'vrbooking'),
		'edit_item'          => __('Изменить бронирование', 'vrbooking'),
		'view_item'          => __('Подробнее', 'vrbooking'),
		'all_items'          => __('Все бронирования', 'vrbooking'),
		'search_items'       => __('Поиск бронирований', 'vrbooking'),
		'not_found'          => __('Бронирований не найдено.', 'vrbooking'),
		'not_found_in_trash' => __('Бронирований не найдено.', 'vrbooking')
		
	);

	$args = array(
	
		'labels'             => $labels,
        'description'        => __('Описание.', 'vrbooking'),
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'capability_type'    => 'post',
		'hierarchical'       => false,
		'menu_position'      => 5,
		'supports'           => array('title')
		
	);
	
	register_post_type(VR_PTYPE, $args);

	/* Промокод */
	$labels_promokod = array(
	
		'name'               => _x('Промокод и цена', VR_PROMOKOD, 'vrbooking'),
		'singular_name'      => _x('Промокод и цена', VR_PROMOKOD, 'vrbooking'),
		'menu_name'          => _x('VR Промокод и цена', 'vrbooking', 'vrbooking'),
		'name_admin_bar'     => _x('Промокод и цена', 'vrbooking', 'vrbooking'),
		'add_new'            => _x('Добавить', 'vrbooking', 'vrbooking'),
		'add_new_item'       => __('Добавить Промокод', 'vrbooking'),
		'new_item'           => __('Добавить', 'vrbooking'),
		'edit_item'          => __('Изменить Промокод', 'vrbooking'),
		'view_item'          => __('Подробнее', 'vrbooking'),
		'all_items'          => __('Промокод и цена', 'vrbooking'),
		'search_items'       => __('Поиск промокодов', 'vrbooking'),
		'not_found'          => __('Промокоды не найдено.', 'vrbooking'),
		'not_found_in_trash' => __('Промокод не найдено.', 'vrbooking')
		
	);

	$args_promokod = array(
	
		'labels'             => $labels_promokod,
        'description'        => __('Описание.', 'vrbooking'),
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'capability_type'    => 'post',
		'hierarchical'       => false,
		'menu_position'      => 5,
		'supports'           => array('title')
		
	);
	
	register_post_type(VR_PROMOKOD, $args_promokod);
	
	/* Страница календаря */
	add_menu_page('VRBooking Календарь', 'VR Календарь', 8, 'vr_calendar', 'vr_calendar_page', '', 7);
	
}

/* Колонки таблицы */
add_filter('manage_'.VR_PTYPE.'_posts_columns', 'vr_columns');

function vr_columns($columns) {
	
	$columns = array(
	
		'cb' => '<input type="checkbox" />',
		'title' => 'Имя клиента',
		'email' => 'E-mail',
		'phone' => 'Телефон',
		'persons' => 'Кол-во посетителей',
		'date_b' => 'Дата бронирования',
		'date_b1' => 'Забронировано на',
		'promo' => 'Промокод',
		'price' => 'Цена',
	
	);
	
	return $columns; 
	
}

add_action('manage_'.VR_PTYPE.'_posts_custom_column' , 'vr_column_value', 10, 2);

function vr_column_value($column, $post_id) {
	
	$name = get_post_meta($post_id, 'vr_name', true);
	$email = get_post_meta($post_id, 'vr_email', true);
	$phone = get_post_meta($post_id, 'vr_phone', true);
	$persons = get_post_meta($post_id, 'vr_persons', true);
	$promo = get_post_meta($post_id, 'vr_promo', true);
	$price = get_post_meta($post_id, 'vr_price', true);
	$dates = get_post_meta($post_id, 'vr_dates', true);
	$dates = unserialize($dates);
	
	if ($column == 'email') {
		echo $email;
	}
	elseif ($column == 'phone') {
		echo $phone;
	}
	elseif ($column == 'persons') {
		echo $persons;
	}
	elseif ($column == 'date_b') {
		
		$tpost = get_post($post_id);
		echo $tpost->post_date;
		
	}
	elseif ($column == 'date_b1') {
		
		foreach ($dates as $date => $times) {
			
			echo '<strong>'.$date.'</strong><br>';
			
			foreach ($times as $time) {
				echo $time.', ';
			}
			
			echo '<br>';
			
		}
		
	}
	elseif ($column == 'promo') {
		echo $promo;
	} 
	elseif ($column == 'price') {
		echo $price;
	}
	
}

/* Подключение скриптов и стилей */
add_action('wp_enqueue_scripts', 'vr_scripts_front');
add_action('admin_enqueue_scripts', 'vr_scripts');

function vr_scripts_front() {
	
	wp_enqueue_script('vrbooking_front', plugin_dir_url(__FILE__).'js/vrbooking_front.js', array('jquery'), NULL, false); 
	
}

function vr_scripts() {
	wp_enqueue_script('jquery-ui-datepicker', '//code.jquery.com/ui/1.12.1/jquery-ui.js', array(), '');
	wp_enqueue_script('vrbooking', plugin_dir_url(__FILE__).'js/vrbooking.js', array(), '1.0');
	wp_enqueue_style('jquery-ui-datepicker', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
	wp_enqueue_style('vrbooking', plugin_dir_url(__FILE__).'css/vrbooking.css');
}

/* Страница календаря */
function vr_calendar_page() {
	
	/* Даты */
	$dates = get_option('vrbooking_calendar');
	$dates = unserialize($dates);
	
	/* Часы */
	$hours = array(
	
		'00:00-01:00',
		'01:00-02:00',
		'02:00-03:00',
		'03:00-04:00',
		'04:00-05:00',
		'05:00-06:00',
		'06:00-07:00',
		'07:00-08:00',
		'08:00-09:00',
		'09:00-10:00',
		'10:00-11:00',
		'11:00-12:00',
		'12:00-13:00',
		'13:00-14:00',
		'14:00-15:00',
		'15:00-16:00',
		'16:00-17:00',
		'17:00-18:00',
		'18:00-19:00',
		'19:00-20:00',
		'20:00-21:00',
		'21:00-22:00',
		'22:00-23:00',
		'23:00-00:00'
	
	);
	
	/* Сохранение календаря */
	if (isset($_POST['time'])) {
		
		$dates = serialize($_POST['time']);	
		update_option('vrbooking_calendar', $dates);
		
		$dates = get_option('vrbooking_calendar', false);
		$dates = unserialize($dates);
		
	}
	
	/* Даты бронирований */
	
		
	?>
	<div class="wrap">
		<h1 class="wp-heading-inline">Календарь бронирований</h1>
		<div class="vrb">
			<div class="vrl">
				<div id="vrc"></div>
			</div>
			<div class="vrr">
				<p>Выберите свободные / занятые часы на выбранную слева дату:</p>
				<?php
				
				/* Вывод часов */
				$counter = 0;
				
				foreach ($hours as $key => $hour) {
					
					$counter++;
					
					if ($counter == 1) {
						echo '<div class="vrh">';
					}
					
					$class = trim(str_replace(':', '_', $hour));
					echo '<a href="javascript:void(0);" title="'.$hour.'" data-cl="'.$class.'" class="vrhour vrh_busy vhrt_'.$class.'">'.$hour.'</a>';
					
					if ($counter == 6) {
						
						echo '</div>';
						$counter = 0;
						
					}
					
				}
				
				?>
			</div>
		</div>
		<form id="vr_form" action="" method="POST">
			<?php
			
			/* Выводим свободные даты */
			if ($dates) {
				
				foreach ($dates as $date => $times) {
					
					foreach ($times as $time => $v) {
						
						$d = str_replace('.', '-', $date);
						echo '<input type="hidden" name="time['.$date.']['.$time.']" value="'.$time.'" class="vrh_'.$d.'_input vrh_input">';
						
					}
					
				}
				
			}
			
			?>
			<input type="submit" value="Сохранить изменения" class="button button-primary">
		</form>
	</div>
	<?php
	
}

/* Оформление заказа */
add_action('wp_ajax_vr_order', 'vr_order');
add_action('wp_ajax_nopriv_vr_order', 'vr_order');
function vr_order() {
	$name = trim($_POST['name']);
	$email = trim($_POST['email']);
	$phone = trim($_POST['phone']);
	$persons = trim($_POST['persons']);
	$promo = trim($_POST['promo']);
	$dts = trim($_POST['dts']);
	$month = trim($_POST['month']);
	$year = trim($_POST['year']);
	$dts = explode(',', $dts);
	$dates = array();
	$email_arr = array();

	array_push($email_arr, $email);
	array_push($email_arr, 'blackfoxvr@gmail.com');
	
	if (empty($name) or empty($phone) or empty($persons)) {
		die(json_encode(array('status' => 'error', 'msg' => 'Заполните все поля формы!')));
	}
	if (!strpos($_POST['dts'], '=')) {
		die(json_encode(array('status' => 'error', 'msg' => 'Выберите дату и время!')));
	}

	$promokod_array = array();
	if( have_rows('promokod', 531) ): 
		while ( have_rows('promokod', 531) ) : the_row();
			$promokod_new = get_sub_field('promokod_new');
			array_push($promokod_array, $promokod_new);
		endwhile;
	endif;	

	/* if (in_array($promo, $promokod_array)) {
		$price_sale = get_field('sale_promokod', 531);
		$price = trim($_POST['price']);
		$price = $price - $price_sale;
	} elseif(empty($promo)) {
		$price = trim($_POST['price']);
	} else {
		$price = trim($_POST['price']);
	} */
	
	$price = trim($_POST['price']);

	foreach ($dts as $d) {
		$d = explode('=', $d);
		$day = trim($d[0]);
		
		$dates[$day][] = trim($d[1]);
		
	}
	$datatime = $dates;

	foreach($datatime as $key => $value){
		$dtsms_mail = $key.' - ';
		foreach($value as $tt){
			$dtsms_mail .=$tt.',';
		}
		break;
	}

	$to = $email_arr;
	$subject = 'Новое бронирование!';

	$body  = 'Имя: ' . $name . '<br>';
	$body .= 'Email: ' . $email . '<br>';
	$body .= 'Дата: ' . $dtsms_mail . ' <br>';
	$body .= 'Кол-во персон: ' . $persons . ' <br>';
	$body .= 'Цена: ' . $price . '<br>';
	$body .= 'Промокод: ' . $promo . '<br>';
	
	$headers = array(
		'From: BlackFoxVr <admin@blackfoxvr.com>',
		'Content-Type: text/html; charset=UTF-8'
	);
	wp_mail($to, $subject, $body, $headers);

	$dates = serialize($dates);

		$phone = substr(preg_replace("/[^0-9]/", '', $phone), -10);
	//var_dump($phone); exit;
	if(strlen($phone) == 10){
		foreach($datatime as $key => $value){
			$dtsms = $key.' - ';
			foreach($value as $tt){
				$dtsms .=$tt.',';
			}
			break;
		}
	
	$mass = $name." %0A";
	$mass .= ($persons == 1 ? $persons.' человек%0A' : $persons.' человека%0A');
	$mass .= 'на '.$dtsms.'%0A';
	$mass .= $price.' гривен%0A';
	$mass .= '0737009007';
	
	$sms_send = file_get_contents('https://smsc.ru/sys/send.php?login=PavelCher&psw=Pavelcher96&charset=utf-8&phones=38'.$phone.',380737009007&mes='.$mass);
	
	}

	/* Почта */
	/*$to = "pavel.cherednichenko.ua@gmail.com";
	$subject = "Новое бронирование";

	$headers = 'From: Info <info@blackfoxvr.com>' . "\r\n"; 
    $headers .= "X-Sender: info <info@blackfoxvr.com \n";
    $headers .= 'X-Mailer: PHP/' . phpversion();
    $headers .= "X-Priority: 1\n"; // Urgent message!
    $headers .= "Return-Path: info@blackfoxvr.com\n"; // Return path for errors
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=utf-8\n";
	
	$message = "Здравствуйте!<br>На сайте совершено новое бронирование комнаты!<br><br><strong>Данные клиента</strong><br><br>";
	$message .= "Имя:" .$name."<br>";
	$message .= "E-mail: ".$email."<br>";
	$message .= "Телефон: ".$phone."<br>";
	$message .= "Кол-во персон: ".$persons."<br><br>";
	$message .= "<i>Это автоматическое уведомление не требует ответа!</i>";*/
	
	/* Добавляем пост */
	$args = array(
	
		'post_title' => $name,
		'post_status' => 'publish',
		'post_type' => VR_PTYPE
	
	);
	
	$post_id = wp_insert_post($args);
	
	/* META */
	add_post_meta($post_id, 'vr_name', $name);
	add_post_meta($post_id, 'vr_email', $email);
	add_post_meta($post_id, 'vr_phone', $phone);
	add_post_meta($post_id, 'vr_persons', $persons);
	add_post_meta($post_id, 'vr_promo', $promo);
	add_post_meta($post_id, 'vr_price', $price);
	add_post_meta($post_id, 'vr_dates', $dates);
	

	
	if (in_array($promo, $promokod_array)) {
		die(json_encode(array('status' => 'ok')));
	} elseif(empty($promo)) {
		die(json_encode(array('status' => 'ok')));
	} else {
		die(json_encode(array('status' => 'error', 'msg' => 'Такого промокода не существует!')));
	}
	die(json_encode(array('status' => 'ok')));
} 

add_action('wp_ajax_vr_promokod', 'vr_promokod');
add_action('wp_ajax_nopriv_vr_promokod', 'vr_promokod');
function vr_promokod() {
	$promo = $_POST['promo'];
	$price_sale = get_field('sale_promokod', 531);
	$get_hc = $_POST['currentCountP'];
	//$price = $_POST['price'];

	/*$promokod_array = array();
	if( have_rows('promokod', 531) ): 
		while ( have_rows('promokod', 531) ) : the_row();
			$promokod_new = get_sub_field('promokod_new');
			array_push($promokod_array, $promokod_new);
		endwhile;
	endif;	*/

	$promokod_array = array();
	$promokod_price_array = array();
	if( have_rows('promokod', 531) ): 
		while ( have_rows('promokod', 531) ) : the_row();
			$promokod_new = get_sub_field('promokod_new');
			$promokod_price = get_sub_field('sale_promokod_promokod');

			array_push($promokod_array, $promokod_new);
			array_push($promokod_price_array, $promokod_price);
		endwhile;
	endif;	

	$key = array_search($promo, $promokod_array);
	$get_price = $promokod_price_array[$key];
	
	$price_array = array();
	if( have_rows('price', 531) ): 
		while ( have_rows('price', 531) ) : the_row();
			$price_new = get_sub_field('sale_person');
			array_push($price_array, $price_new);
		endwhile;
    endif;
	$price = $price_array[0] * $_POST['persons'] * $get_hc;


	if (in_array($promo, $promokod_array)) {
		$price = $price - $get_price * $_POST['persons'];
		echo $price;
	} else {
		echo $price;
	}

	die;
}

add_action('wp_ajax_vr_hours', 'vr_hours');
add_action('wp_ajax_nopriv_vr_hours', 'vr_hours');
function vr_hours() {
	/*$get_hc = $_POST['currentCount'];
	$get_price = $_POST['price'];
	$finish_price = $get_price * $get_hc;
	echo $finish_price;*/

	$get_hc = $_POST['currentCount'];
	$promo = $_POST['promo'];
	$price_sale = get_field('sale_promokod', 531);
	//$price = $_POST['price'];

	$promokod_array = array();
	$promokod_price_array = array();
	if( have_rows('promokod', 531) ): 
		while ( have_rows('promokod', 531) ) : the_row();
			$promokod_new = get_sub_field('promokod_new');
			$promokod_price = get_sub_field('sale_promokod_promokod');

			array_push($promokod_array, $promokod_new);
			array_push($promokod_price_array, $promokod_price);
		endwhile;
	endif;	

	$key = array_search($promo, $promokod_array);
	$get_price = $promokod_price_array[$key];

	$price_array = array();
	if( have_rows('price', 531) ): 
		while ( have_rows('price', 531) ) : the_row();
			$price_new = get_sub_field('sale_person');
			array_push($price_array, $price_new);
		endwhile;
    endif;
	$price = $price_array[0] * $_POST['persons']  * $get_hc;


	if (in_array($promo, $promokod_array)) {
		$price = $price - $get_price * $_POST['persons']  * $get_hc;
		echo $price;
	} else {
		echo $price;
	}
	die();
}
?>