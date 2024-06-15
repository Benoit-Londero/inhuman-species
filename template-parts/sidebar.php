<div class="menu-sidebar">
    <?php 
    $logo = get_field('logo','options');?>

    <?php if($logo):?>
        <div class="logo">
            <a href="<?php echo get_home_url();?>">
                <img src="<?php echo $logo  ['url'];?>" alt="<?php echo $logo['name'];?>"/>
            </a>
        </div>
    <?php endif;?>

    <?php
        wp_nav_menu( array(
            'menu' => 'Menu Principal',
            'theme_location' => 'main'
        ));
    ?>

    <div class="social_network">
        <?php if(have_rows('reseaux_sociaux','options')):
                while(have_rows('reseaux_sociaux','options')): the_row();

                    $icon = get_sub_field('icone');
                    $lien = get_sub_field('lien');

                ?>
                
                <a href="<?php echo $lien;?>">
                    <img src="<?php echo $icon['url'];?>" alt="<?php echo $icon['name'];?>"/>
                </a>

                <?php

                endwhile;
            endif;
        ?>
    </div>
</div>