<?php 

/* Template Name: A propos*/

get_header();

$descr = get_field('description');
$photo = get_field('photo_about');
?>


<div id="content-contact">
    <div class="container columns">
        <div class="col-g">
            <?php if($photo):?>
                <div class="block-img from-bottom">
                    <img src="<?php echo $photo['url'];?>" alt="<?php echo $photo['name'];?>" />
                </div>
            <?php endif;?>
        </div>

        <div class="col-d from-bottom">
            <?php if($descr):?>
                <?php echo $descr;?>
            <?php endif;?>
        </div>
    </div>
</div>


<?php get_footer();?>