<?php
/**
 * Slider plein écran (widget "Swiper Fullscreen" et template Portfolio).
 *
 * @param array $args {
 *     @type array  $slides     Liste de slides : image { id, url }, description (HTML), cta { url, label, is_external, nofollow }.
 *     @type array  $options    Options Swiper (speed, loop, autoplay, navigation, pagination).
 *     @type string $background URL d'une image de fond (optionnel).
 * }
 *
 * @package Inhuman_Species
 */

defined( 'ABSPATH' ) || exit;

$slides     = $args['slides'] ?? array();
$options    = $args['options'] ?? array();
$background = $args['background'] ?? '';

$show_navigation = $options['navigation'] ?? true;
$show_pagination = $options['pagination'] ?? true;

if ( empty( $slides ) ) {
    return;
}
?>

<div class="portfolio"<?php if ( $background ) : ?> style="background-image: url('<?php echo esc_url( $background ); ?>');"<?php endif; ?>>
    <div class="swiper">
        <div class="swiper-portfolio" data-swiper-options="<?php echo esc_attr( wp_json_encode( $options ) ); ?>">
            <div class="swiper-wrapper">
                <?php foreach ( array_values( $slides ) as $index => $slide ) :
                    $image = $slide['image'] ?? array();
                    $cta   = $slide['cta'] ?? array();
                    $rel   = array();

                    if ( ! empty( $cta['is_external'] ) ) {
                        $rel[] = 'noopener';
                        $rel[] = 'noreferrer';
                    }

                    if ( ! empty( $cta['nofollow'] ) ) {
                        $rel[] = 'nofollow';
                    }
                    ?>
                    <div class="swiper-slide">
                        <div class="description from-left" data-swiper-parallax="-300" data-swiper-parallax-duration="300">
                            <?php echo wp_kses_post( $slide['description'] ?? '' ); ?>

                            <?php if ( ! empty( $cta['url'] ) && ! empty( $cta['label'] ) ) : ?>
                                <a
                                    href="<?php echo esc_url( $cta['url'] ); ?>"
                                    class="cta from-left"
                                    <?php if ( ! empty( $cta['is_external'] ) ) : ?>target="_blank"<?php endif; ?>
                                    <?php if ( $rel ) : ?>rel="<?php echo esc_attr( implode( ' ', $rel ) ); ?>"<?php endif; ?>
                                >
                                    <?php echo esc_html( $cta['label'] ); ?>
                                </a>
                            <?php endif; ?>
                        </div>

                        <div class="block-img" data-swiper-parallax="0">
                            <?php
                            inhuman_species_image(
                                $image['id'] ?? 0,
                                $image['url'] ?? '',
                                'full',
                                array(
                                    'class'         => 'slide',
                                    'loading'       => 0 === $index ? 'eager' : 'lazy',
                                    'fetchpriority' => 0 === $index ? 'high' : 'auto',
                                    'sizes'         => '100vw',
                                )
                            );
                            ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if ( $show_pagination ) : ?>
                <div class="swiper-pagination"></div>
            <?php endif; ?>

            <?php if ( $show_navigation ) : ?>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            <?php endif; ?>
        </div>
    </div>
</div>
