<?php 

/* Template Name: Simple*/

get_header();

$descr = get_field('description');
$photo = get_field('photo_about');

$isGalerie = get_field('isGalerie');

?>

<div id="content-contact">
    <div class="container columns">
        <div class="col-g">
            <?php if($descr):?>
                <?php echo $descr;?>
            <?php endif;?>
        </div>

        <div class="col-d from-bottom">
            <?php if($isGalerie):
                $galerie = get_field('galerie');

                foreach($galerie as $g):?>
                    <div class="block-ig from-bottom">
                        <img src="<?php echo $g['url'];?>" alt="<?php echo $g['name'];?>" />
                    </div>
                <?php endforeach;
            
            else : ?>
                <div class="block-img from-bottom">
                    <img src="<?php echo $photo['url'];?>" alt="<?php echo $photo['name'];?>" />
                </div>
            <?php endif;?>
        </div>
    </div>
</div>


<?php get_footer();?>