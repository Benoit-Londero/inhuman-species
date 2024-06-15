<?php
/* Template Name: Page d'accueil */

get_header(); 

$background = get_field('background');?>

<div id="main-content"
    <?php if($background): echo "style=\"background-image:url('".$background['url']."'); height:100vh; width:100vw; background-size:cover;\""; endif;?>
>

</div>

<?php get_footer(); ?>