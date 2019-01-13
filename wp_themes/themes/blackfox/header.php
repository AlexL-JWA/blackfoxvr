<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" id="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <link rel="shortcut icon" type="image/png" href="<?php bloginfo('template_url') ?>/img/favicon.png" />
    <!--(if lt IE 9)
    script(src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js")
    script(src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js")
    -->
    <!--(endif)-->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-130998749-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-130998749-1');
    </script>

    <?php 
      wp_head(); 
      $contact = get_field('contact', 'options');
    ?>
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
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><a class="logo" href="/"><img src="<?php the_field('logo_white', 'options'); ?>"
                            alt="Logo"></a>
                    <div class="burger-menu"><span></span><span></span><span></span></div>
                    <div class="menu-block">
                        <ul class="contact">
                            <li class="icon-marker"><a href="<?php echo $contact['adress_text'] ?>">
                                    <?php echo $contact['adress_text'] ?></a></li>
                            <li class="icon-mobile"><a href="tel:<?php echo $contact['tel_link'] ?>">
                                    <?php echo $contact['tel_text'] ?></a>
                                <!--                	<a href="tel:<//?php the_field('phone_s'); ?>"><//s?php the_field('phone_s'); ?></a>-->
                            </li>
                        </ul><a class="button" href="#" data-toggle="modal" data-target=".registration">Заказать звонок</a>
                        <?php 
                          wp_nav_menu( array(
                            'theme_location'  => 'Header',
                            'menu'            => 'main-menu', 
                            'container'       => '', 
                            'container_class' => '', 
                            'container_id'    => '',
                            'menu_class'      => 'menu', 
                            'menu_id'         => '',
                            'echo'            => true,
                            'fallback_cb'     => 'wp_page_menu',
                            'before'          => '',
                            'after'           => '',
                            'link_before'     => '',
                            'link_after'      => '',
                            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'depth'           => 0,
                            'walker'          => '',
                          ) );
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </header>