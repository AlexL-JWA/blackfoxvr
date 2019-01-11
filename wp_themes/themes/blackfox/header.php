<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" id="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <link rel="shortcut icon" type="image/png" href="<?php bloginfo('template_url') ?>/img/favicon.png"/>
    <!--(if lt IE 9)
    script(src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js")
    script(src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js")
    -->
    <!--(endif)-->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-130998749-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-130998749-1');
    </script>

    <?php wp_head(); ?>
  </head>
  <body>
    <div class="preloader">
      <div class="preloader-content">
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/preloader.svg" alt="Preloader image">
        <div class="preloader-num">0%</div>
        <div class="line">
          <div class="preloader-line"></div>
        </div>
      </div>
    </div>
    <header>
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><a class="logo" href="/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.png" alt="Logo"></a>
          <div class="burger-menu"><span></span><span></span><span></span></div>  
          <div class="menu-block">
              <ul class="contact">
                <li class="icon-marker"><a href="#"><?php the_field('address'); ?></a></li>
                <li class="icon-mobile"><a href="tel:<?php the_field('phone_f'); ?>"><?php the_field('phone_f'); ?></a>
<!--                	<a href="tel:<//?php the_field('phone_s'); ?>"><//s?php the_field('phone_s'); ?></a>-->
                </li>
              </ul><a class="button" href="#" data-toggle="modal" data-target=".registration">Заказать звонок</a>
              <ul class="menu">
                <li><a href="#scroll-about-us">О НАС</a></li>
                <li><a href="#scroll-our-games">ИГРЫ</a></li>
                <li><a href="#scroll-calendar">КАЛЕНДАРЬ</a></li>
                <li><a href="#scroll-gallery">ГАЛЕРЕЯ</a></li>
                <li><a href="#scroll-footer">КОНТАКТЫ</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </header>