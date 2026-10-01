<?php
/**
 * Gabarit par défaut (pages Elementor, articles, archives).
 *
 * @package Inhuman_Species
 */

get_header();

if ( have_posts() ) :
    if ( is_singular() ) :
        while ( have_posts() ) : the_post();
            the_content();
        endwhile;
    else : ?>
        <div class="container content-archive">
            <?php while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <?php the_excerpt(); ?>
                </article>
            <?php endwhile; ?>

            <?php the_posts_pagination(); ?>
        </div>
    <?php endif;
endif;

get_footer();
