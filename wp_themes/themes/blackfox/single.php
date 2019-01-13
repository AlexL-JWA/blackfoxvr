<?php get_header();?>
<?php 
  $banner = get_field('banner_in_blog', 'options');
?>
<section class="blog-page">
    <div class="banner-min" style="background-image:url(<?php echo $banner;?>)">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h2>
                        <?php the_title();?>
                    </h2>
                    <h3>
                        <?php the_time('d.m.Y');?>
                    </h3><a class="button" href="<?php echo get_home_url();?>">На главную</a>
                </div>
            </div>
        </div>
    </div>
    <div class="blog-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?php if ( have_posts() ) :  while ( have_posts() ) : the_post(); ?>
                    <?php the_content();?>
                    <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer( );?>