<?php
/**
 * Single template for the Dice post type.
 *
 * @package dice-nerdwallet
 */

get_header();
?>

<main id="primary" class="dice-single">
    <div class="fa-container">
        <?php while ( have_posts() ) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class('dice-article'); ?>>

            <?php if ( has_post_thumbnail() ) : ?>
            <div class="dice-single__image">
                <?php the_post_thumbnail( 'large', [ 'loading' => 'lazy' ] ); ?>
            </div>
            <?php endif; ?>

            <div class="dice-single__header">
                <h1 class="dice-single__title"><?php the_title(); ?></h1>

                <?php
                $campaigns = get_the_terms( get_the_ID(), 'campaign' );
                if ( $campaigns && ! is_wp_error( $campaigns ) ) : ?>
                <div class="dice-single__campaigns">
                    <?php foreach ( $campaigns as $campaign ) : ?>
                    <span class="dice-single__campaign-tag">
                        <?php echo esc_html( $campaign->name ); ?>
                    </span>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <div class="dice-single__author">
                    <div class="dice-single__avatar">
                        <?php echo get_avatar( get_the_author_meta( 'ID' ), 56 ); ?>
                    </div>
                    <div class="dice-single__author-info">
                        <strong><?php the_author(); ?></strong>
                        <p><?php the_author_meta( 'description' ); ?></p>
                    </div>
                </div>
            </div>

            <div class="dice-single__content">
                <?php the_content(); ?>
            </div>

        </article>

        <?php endwhile; ?>
    </div>
</main>

<?php
get_footer();