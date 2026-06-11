<?php
/**
 * Template Name: Dice Loop
 *
 * @package dice-nerdwallet
 */

get_header();

$dice_query = new WP_Query([
    'post_type'      => 'dice',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
]);
?>

<main id="primary" class="dice-loop">
    <div class="fa-container">
        <h1 class="dice-loop__title"><?php the_title(); ?></h1>

        <?php if ( $dice_query->have_posts() ) : ?>
       <div class="dice-loop__grid">
            <?php while ( $dice_query->have_posts() ) : $dice_query->the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('dice-loop__card'); ?>>

                <div class="dice-loop__card-image">
                    <a href="<?php the_permalink(); ?>">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'medium', [ 'loading' => 'lazy' ] ); ?>
                        <?php else : ?>
                            <div class="dice-loop__card-placeholder"></div>
                        <?php endif; ?>
                    </a>
                </div>

                <div class="dice-loop__card-body">
                    <h2 class="dice-loop__card-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>

                    <div class="dice-loop__card-excerpt">
                        <?php the_excerpt(); ?>
                    </div>

                    <a href="<?php the_permalink(); ?>" class="fa-btn fa-btn--secondary fa-btn--sm">
                        Read More
                    </a>
                </div>

            </article>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php else : ?>
        <p>No dice posts found.</p>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();