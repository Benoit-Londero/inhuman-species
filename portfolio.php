<?php
/* Template Name: Portfolio */

$bg = get_field('background-slider');

get_header();
?>

<div class="portfolio" <?php if($bg): ?> style="background-image:url('<?php echo $bg['url'];?>);" <?php endif;?>>
    <div class="swiper">
        <div class="swiper-portfolio">
            <div class="swiper-wrapper">
                <?php
                
                if(have_rows('work')):
                    while(have_rows('work')): the_row();
                        $img = get_sub_field('image');
                        $desc = get_sub_field('description');
                        $cta = get_sub_field('cta');

                        if($img):?>
                            <div class="swiper-slide">
                                <div class="description from-left" data-swiper-parallax="-300" data-swiper-parallax-duration="300" style="z-index:1000;">
                                    <?php if($desc): echo $desc; endif;?>

                                    <?php if($cta): echo '<a href="'.$cta['url'].'" class="cta from-left">'.$cta['title'].'</a>'; endif;?>
                                </div>

                                <div class="block-img" data-swiper-parallax="0">
                                    <img src="<?php echo $img['url'];?>" alt="<?php echo $img['name'];?>" class="slide"/>
                                </div>
                            </div>
                        <?php endif;
                    endwhile;
                endif;?>
            </div>

            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
</div>

<?php get_footer();?>