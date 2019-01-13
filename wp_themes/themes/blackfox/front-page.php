<?php
get_header(); ?>
<section>
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="banner-content">
                        <h1>
                            <?php the_field('title'); ?>
                        </h1>
                        <p>
                            <?php the_field('descriptions'); ?>
                        </p><a class="button" href="#scroll-calendar">Записаться на игру</a>
                    </div>
                </div>
            </div>
        </div><a class="icon-mouse" href="#about-us"></a>
    </div>
    <div class="about-us" id="scroll-about-us">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h2>
                        <?php the_field('title_about'); ?>
                    </h2>
                    <h5>
                        <?php the_field('descriptions_title'); ?>
                    </h5>
                    <div class="about-content">
                        <div class="img">
                            <?php 
                $image = get_field('images');
                if( !empty($image) ): ?>
                            <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                            <?php endif; ?>
                        </div>
                        <div class="description">
                            <p>
                                <?php the_field('descriptions_about'); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="our-games" id="scroll-our-games">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h2>Наши игры</h2>
                    <h5>В нашем зале предоставлено большое количество игр на ваш вкус</h5>
                    <ul class="buttons">
                        <li class="active"> <a class="button vr" href="#vr" data-toggle="tab">VR</a></li>
                        <li><a class="button ps" href="#ps" data-toggle="tab">PS 4</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="vr">
                            <div class="slider-games vr">
                                <?php 
                        $args = array( 
                            'post_type'      => 'games', 
                            'posts_per_page' => -1,
                            'category_name'  => 'vr',
                            'post_status'    => 'publish'
                        );
                        $loop = new WP_Query( $args );
                        if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); ?>
                                <div class="item">
                                    <div class="img"><img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="#">
                                        <div class="desc"><i class="icon-close"></i>
                                            <h3>
                                                <?php the_title(); ?>
                                            </h3>
                                            <?php
                                        $field = get_field_object('demo_new');
                                        $games = $field['value']; ?>
                                            <ul>
                                                <?php foreach($games as $game) { ?>
                                                <?php if($game == 'DEMO') { ?>
                                                <li class="demo">
                                                    <?php echo $field['DEMO'][ $game ]; ?>DEMO</li>
                                                <?php } elseif ($game == 'NEW') { ?>
                                                <li class="new">
                                                    <?php echo $field['NEW'][ $game ]; ?>NEW</li>
                                                <?php } elseif($game == 'DEMO' && $game == 'NEW') { ?>
                                                <li class="demo">
                                                    <?php echo $field['DEMO'][ $game ]; ?>DEMO</li>
                                                <li class="new">
                                                    <?php echo $field['NEW'][ $game ]; ?>NEW</li>
                                                <?php }
                                            } ?>
                                            </ul>
                                            <i class="icon-<?php the_field('isons_person'); ?>">
                                                <?php the_field('number_persons'); ?></i>
                                            <?php the_content(); ?>
                                            <a class="button" href="#scroll-calendar"> Записаться на игру</a>
                                        </div><a class="more"><span>Подробнее</span></a>
                                    </div>
                                    <h3>
                                        <?php the_title(); ?>
                                    </h3>
                                    <p>
                                        <?php $content = get_the_content(); 
                                echo mb_strimwidth($content, 0, 50, '...'); ?>
                                    </p>
                                </div>
                                <?php endwhile;
                        endif;
                        wp_reset_postdata();
                    ?>
                            </div>
                        </div>
                        <div class="tab-pane" id="ps">
                            <h2>Cкоро открытие <span>vip</span> комнат для игры на PS4</h2>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="our-advantages">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h2>
                        <?php the_field('title_advantages'); ?>
                    </h2>
                    <h5>
                        <?php the_field('descriptions_advantages'); ?>
                    </h5>
                    <div class="items">
                        <?php if( have_rows('advantages') ): while ( have_rows('advantages') ) : the_row(); ?>
                        <div class="item"><i class="icon-<?php the_sub_field('icon_advantages'); ?>"></i>
                            <p>
                                <?php the_sub_field('name_advantages'); ?>
                            </p>
                        </div>
                        <?php endwhile; endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="the-calendar" id="scroll-calendar">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h2>Календарь</h2>
                    <h5>Запишитесь на сеанс игры в удобное для Вас время</h5>
                    <div class="calendar-block">
                        <div class="left-block">
                            <div class="datepicker">
                                <input class="hide" type="text">
                                <input id="currentCount" name="currentCount" type="hidden" value="1">
                                <div class="calendar"></div>
                            </div>
                        </div>
                        <div class="right-block">
                            <form id="scroll-form" action="" method="POST" class="vrbooking">
                                <div class="input">
                                    <label>Ваше Имя</label>
                                    <input type="text" name="name" placeholder="Введите Ваше имя">
                                </div>
                                <div class="input">
                                    <label>Ваш Email <span>(не обязательно)</span></label>
                                    <input type="email" name="email" placeholder="Введите Ваше Email">
                                </div>
                                <div class="input">
                                    <label>Ваш номер телефона</label>
                                    <input type="tel" name="phone" placeholder="Введите Ваш номер телефона">
                                </div>
                                <div class="select-block">
                                    <label>Кол-во посетителей</label>
                                    <select id="selperson" name="persons">
                                        <option value="1" selected>1 чел</option>
                                        <option value="2">2 чел</option>
                                        <option value="3">3 чел</option>
                                        <option value="4">4 чел</option>
                                    </select>
                                </div>
                                <div class="input-promo">
                                    <label>Промо код</label>
                                    <input type="text" name="promo" placeholder="Введите промо код">
                                </div>
                                <?php 
                    $price_array = array();
                    if( have_rows('price', 531) ): 
                        while ( have_rows('price', 531) ) : the_row();
                            $price_new = get_sub_field('sale_person');
                            array_push($price_array, $price_new);
                        endwhile;
                    endif; ?>
                                <input id="price" name="price" type="hidden" value="<?php echo $price_array[0]; ?>">
                                <h3 class="price">Цена <span>
                                        <?php echo $price_array[0]; ?></span><strong> грн</strong></h3>
                                <div class="button">
                                    <input type="submit" value="Оформить бронь">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="banner-min" style="background-image:url(<?php echo get_stylesheet_directory_uri(); ?>/img_clients/banner-bg-2.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h2>
                        <?php the_field('title_banner'); ?>
                    </h2><a class="button" href="#scroll-calendar">Отправить заявку</a>
                </div>
            </div>
        </div>
    </div>
    <div class="gallery" id="scroll-gallery">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h2>
                        <?php the_field('title_gallery'); ?>
                    </h2>
                    <h5>
                        <?php the_field('description_gallery'); ?>
                    </h5>
                    <div class="slider-gallery">
                        <?php 
                $images = get_field('gallery');
                if( $images ): ?>
                        <?php foreach( $images as $image ): ?>
                        <div class="item"><a data-fancybox="gallery" href="<?php echo $image['url']; ?>"><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
                                <span>Подробнее</span></a>
                        </div>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="reviews">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h2>
                        <?php the_field('title_reviews'); ?>
                    </h2>
                    <h5>
                        <?php the_field('descriptions_reviews'); ?>
                    </h5>
                    <div class="slider-reviews">
                        <?php if( have_rows('reviews') ): while( have_rows('reviews') ): the_row(); 
                    $full_name      = get_sub_field('full_name');
                    $position       = get_sub_field('position');
                    $reviews_full   = get_sub_field('reviews_full');
                    $image          = get_sub_field('photo_reviews'); ?>
                        <div class="item">
                            <?php if( $image ) { ?>
                            <div class="img icon-user">
                                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>">
                            </div>
                            <?php } else { ?>
                            <div class="img icon-user"></div>
                            <?php } ?>
                            <div class="description">
                                <h3>
                                    <?php echo $full_name; ?><span>
                                        <?php echo $position; ?></span></h3>
                                <p>
                                    <?php echo $reviews_full; ?>
                                </p>
                            </div>
                        </div>
                        <?php endwhile; endif; ?>
                    </div><a class="button" href="#" data-toggle="modal" data-target=".modal-reviews">Оставить отзыв</a>
                </div>
            </div>
        </div>
    </div>
    <div class="blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h2>
                        <?php the_field('blog_title');?>
                    </h2>
                    <h5>
                        <?php the_field('sub_title_blog');?>
                    </h5>
                    <div class="blog-items start-item">
                        <?php
                        
                                $args = array(
                                    'post_type' => 'post',
                                    'posts_per_page' => 4,
                                    'page' => get_query_var('paged') ?: 1
                                );

                                $query = new WP_Query( $args );

                        
                                if ( $query->have_posts() ) {
                                    while ( $query->have_posts() ) {
                                        $query->the_post();
                                        get_template_part('post-content', 'front-page');
                                        
                                    }
                                }
                                
                              ?>

                    </div>
                    <div class="blog-item load">

                    </div>
                    <?php 
                    //   global  $wp_query ; // вы можете удалить эту строку, если у вас все работает
                                          // не отображать кнопку, если сообщений недостаточно 
                                        //   echo $wp_query;
                    //   if($wp_query -> max_num_pages > 1 ) 
                        echo  '<a class="button btn-loadeMore" href="#">Все статьи</a>' ; // вы также можете использовать <a> 
                        wp_reset_postdata();
                    ?>

                </div>
            </div>
        </div>
    </div>
</section>

<div>

    <?php get_footer();?>