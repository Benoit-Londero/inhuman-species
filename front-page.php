<?php
/* Template Name: Page d'accueil */

get_header(); 

$background = get_field('background');
$background_2 = get_field('background_2');

?>

<div id="main-content">
    <?php if($background): echo "<img src=\"".$background['url']."\" alt=\"".$background['name']."\" class=\"image-before\" />"; endif;?>
    <?php if($background_2): echo "<img src=\"".$background_2['url']."\" alt=\"".$background_2['name']."\" class=\"image-after\" />"; endif;?>
</div>

<?php get_footer(); ?>