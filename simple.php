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
            <?php if($descr): echo $descr; endif;?>
        </div>

        <div class="col-d from-bottom">
            <?php if($isGalerie):
                $galerie = get_field('galerie');

                echo 
                '<div class="swiper swiper-project">
                    <div class="swiper-wrapper">';

                    foreach($galerie as $g):?>
                        <div class="swiper-slide">
                            <a data-fslightbox href="<?= $g['url'];?>">
                                <div class="block-ig from-bottom">
                                    <img src="<?= $g['url'];?>" alt="<?= $g['name'];?>" />
                                </div>
                            </a>
                        </div>
                    <?php endforeach;

                echo '</div>
                </div>';
            
            else : ?>
                <div class="block-img from-bottom">
                    <img src="<?= $photo['url'];?>" alt="<?= $photo['name'];?>" />
                </div>
            <?php endif;?>
        </div>
    </div>
</div>


<?php get_footer();?>