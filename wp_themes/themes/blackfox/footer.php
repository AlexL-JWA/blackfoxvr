<footer id="scroll-footer">
      <div class="top-block">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <ul class="contacts">
                <li class="icon-mail"><a href="mailto:<?php the_field('email'); ?>"><?php the_field('email'); ?></a></li>
                <li class="icon-mobile"><a href="tel:<?php the_field('phone_footer'); ?>"><?php the_field('phone_footer'); ?></a></li>
                <li class="icon-marker"><a href=""><?php the_field('address_footer'); ?></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="menu-block">
                <ul class="menu">
                    <li><a href="#scroll-about-us">О НАС</a></li>
                    <li><a href="#scroll-our-games">ИГРЫ</a></li>
                    <li><a href="#scroll-calendar">КАЛЕНДАРЬ</a></li>
                    <li><a href="#scroll-gallery">ГАЛЕРЕЯ</a></li>
                    <li><a href="#scroll-footer">КОНТАКТЫ</a></li>
                </ul>
                <ul class="soc">
                    <?php
                    if( have_rows('social') ):
                    while ( have_rows('social') ) : the_row(); ?>
                        <li><a class="icon-<?php the_sub_field('icon_social'); ?>" href="<?php the_sub_field('url_social'); ?>" target="_blank"></a></li>
                    <?php endwhile;
                    endif; ?>
                </ul>
            </div>
            <div id="map"></div>
            <div class="copiright">
              <p><?php the_field('copiright'); ?></p>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <div class="modal fade registration" role="dialog">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-head">
            <h3>Оформление заявки</h3>
          </div>
          <?php echo do_shortcode('[contact-form-7 id="405" title="Заказать звонок"]'); ?>
        </div>
      </div>
    </div>
    <div class="modal fade vrb alert" role="dialog">
      <div class="modal-dialog modal-sm">
        <div class="modal-content"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.png" alt="logo">
          <h3>Спасибо за бронирование!</h3>
          <p>Наш менеджер свяжется с Вами в близжайшее время</p><a class="button" href="/">Вернуться на главную</a>
        </div>
      </div>
    </div>
    <div class="modal fade alert" role="dialog">
      <div class="modal-dialog modal-sm">
        <div class="modal-content"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.png" alt="logo">
          <h3>Ваша заявка принята!</h3>
          <p>Наш менеджер свяжется с Вами в близжайшее время</p><a class="button" href="/">Вернуться на главную</a>
        </div>
      </div>
    </div>
    <div class="modal fade modal-reviews" role="dialog">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-head">
            <h3>Отзыв</h3>
          </div>
          <?php echo do_shortcode('[contact-form-7 id="406" title="Отзывы"]'); ?>
        </div>
      </div>
    </div>
	<?php
	
	/* Часы */
	$hours = array(
	
		'00:00-01:00' => 'disabled',
		'01:00-02:00' => 'disabled',
		'02:00-03:00' => 'disabled',
		'03:00-04:00' => 'disabled',
		'04:00-05:00' => 'disabled',
		'05:00-06:00' => 'disabled',
		'06:00-07:00' => 'disabled',
		'07:00-08:00' => 'disabled',
		'08:00-09:00' => 'disabled',
		'09:00-10:00' => 'disabled',
		'10:00-11:00' => 'disabled',
		'11:00-12:00' => 'disabled',
		'12:00-13:00' => 'disabled',
		'13:00-14:00' => 'disabled',
		'14:00-15:00' => 'disabled',
		'15:00-16:00' => 'disabled',
		'16:00-17:00' => 'disabled',
		'17:00-18:00' => 'disabled',
		'18:00-19:00' => 'disabled',
		'19:00-20:00' => 'disabled',
		'20:00-21:00' => 'disabled',
		'21:00-22:00' => 'disabled',
		'22:00-23:00' => 'disabled',
		'23:00-00:00' => 'disabled'
	
	);
	
	/* Даты */
  $dates = get_option('vrbooking_calendar', false);
  //delete_option('vrbooking_calendar');
	$dates = unserialize($dates);
  $av_times = array();
  
  $get_month = date('n');
  $get_yaer = date("Y");

	if ($dates) {
		
		foreach ($dates as $date => $times) {
			
            //$date = explode('.', $date);
            
            $day = $date;
            $av_times[$day] = $hours;

			
			foreach ($times as $time) {
				
				$time = trim(str_replace('_', ':', $time));
				
				if (strpos($time, '=')) {
					
					$time = explode('=', $time);
					$time = trim($time[1]);
					
				}

				
                $av_times[$day][$time] = '';
				
			}
			
		}

	
	}
	
	/* Даты бронирований */
	$avb = get_posts('post_type=vrbooking');
	
	if ($avb) {
		
		foreach ($avb as $vrb) {
			
			$this_dates = get_post_meta($vrb->ID, 'vr_dates', true);
			$this_dates = unserialize($this_dates);            

			if (!$this_dates) {
				continue;
			}
			
			foreach ($this_dates as $date => $times) {
				
				foreach ($times as $time) {
					
					$this_date = $date;   
					$this_day = trim($this_date);
                    $av_times[$this_day][$time] = 'disabled';
                    
					
				}
				
			}
			
		}
		
	}
	
	
	foreach ($av_times as $day => $times) {
		
		/*$day = (int)$day;
		if ($day < 10) {
			$day = $day;
    }*/
		
		echo '<div class="datepicker-time hide" data-hours="day-' . $day . '.' . $get_month . '.' . $get_yaer . '">';
		echo '<div class="tr hours">';
		
		foreach ($times as $time => $status) {
			
			$time = trim($time);
			if (strpos($time, '=')) {
				
				$time = explode('=', $time);
				$time = trim($time[1]);
				
			}
			
			echo '<div data-day="' . $day . '.' . $get_month . '.' . $get_yaer . '" class="td hour '.$status.'">'.$time.'</div>';
		}
		
		echo '</div>';
		echo '</div>';
		
	}
	
	?>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDkq10qGjGPTgmSBxGwogWSRC3fDHIHvrc&amp;callback=initMap"></script> 
    <?php wp_footer(); ?>
  </body>
</html>