<div class="item">
    <div class="img">
        <?php if(has_post_thumbnail()):?>
        <?php the_post_thumbnail();?>
        <?php else:?>
        <img src="https://via.placeholder.com/263x214.png?text=Image+Not+Set" alt="thumbnail not set">
        <?php endif;?>
    </div>
    <a class="link" href="<?php the_permalink( );?>"></a>
    <h3>
        <?php the_title();?>
    </h3>
    <p>
        <?php the_excerpt();?>
    </p>
</div>