<?php get_header();?>

<div id="content-shop">
    <div class="container">
        <?php 
            if( have_posts()):
                woocommerce_content();
            endif;
        ?>
    </div>
</div>

<?php get_footer();   