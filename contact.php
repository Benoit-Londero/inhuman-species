<?php 

/* Template Name: Contact */

get_header();?>


<div id="content-contact">
    <div class="container">
        <h1 class="from-left"><?php echo the_title();?></h1>
        <?php 
            $form = get_field('formulaire','options');

            if($form):
                echo '<span class="from-left">'. do_shortcode($form) . '</span>';
            endif;
        ?>
    </div>
</div>


<?php get_footer();?>