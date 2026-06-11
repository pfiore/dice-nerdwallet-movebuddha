<?php

function dice_nerdwallet_enqueue_styles() {
    $parent_style = 'dice-style';
 
    wp_enqueue_style(
        $parent_style,
        get_template_directory_uri() . '/style.css'
    );
    wp_enqueue_style(
        'dice-nerdwallet-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get( 'Version' )
    );
       wp_enqueue_script(
        'dice-nerdwallet-faq',
        get_stylesheet_directory_uri() . '/js/faq.js',
        array(),
        '1.0.0',
        true
    );
}
add_action( 'wp_enqueue_scripts', 'dice_nerdwallet_enqueue_styles' );

/**
 * Register custom meta fields for the Financial Advisors landing page.
 */
function dice_nerdwallet_register_meta() {
    $fields = [
        // Hero Section
        'hero_headline'    => 'string',
        'hero_subheadline' => 'string',
        'hero_cta_text'    => 'string',
        'hero_cta_url'     => 'string',
        'hero_image'      => 'string',

        // Trust & Authority
        'author_name'      => 'string',
        'author_bio'       => 'string',
        'editorial_policy' => 'string',
        'author_image'     => 'string',

        // Conversion Section
        'cta_headline'     => 'string',
        'cta_trust_note'   => 'string',

        // Footer
        'disclaimer'       => 'string',
    ];

    foreach ( $fields as $key => $type ) {
        register_post_meta( 'page', $key, [
            'show_in_rest' => true,
            'single'       => true,
            'type'         => $type,
        ] );
    }
}
add_action( 'init', 'dice_nerdwallet_register_meta' );

/**
 * Add meta box for Financial Advisors fields.
 */
function dice_nerdwallet_add_meta_box() {
    add_meta_box(
        'dice_nerdwallet_fields',
        'Financial Advisors Content',
        'dice_nerdwallet_meta_box_html',
        'page',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'dice_nerdwallet_add_meta_box' );

/**
 * Meta box HTML output.
 */
function dice_nerdwallet_meta_box_html( $post ) {
    wp_nonce_field( 'dice_nerdwallet_save_meta', 'dice_nerdwallet_nonce' );

    $fields = [
        'hero_headline'    => 'Hero Headline',
        'hero_subheadline' => 'Hero Subheadline',
        'hero_cta_text'    => 'CTA Button Text',
        'hero_cta_url'     => 'CTA Button URL',
        'hero_image'       => 'Hero Image URL',
        'author_name'      => 'Author Name',
        'author_bio'       => 'Author Bio',
        'author_image' => 'Author Headshot URL',
        'editorial_policy' => 'Editorial Policy',
        'cta_headline'     => 'Conversion Section Headline',
        'cta_trust_note'   => 'Conversion Trust Note',
        'disclaimer'       => 'Footer Disclaimer',
    ];

    foreach ( $fields as $key => $label ) {
        $value = get_post_meta( $post->ID, $key, true );
        ?>
        <p>
            <label for="<?php echo esc_attr( $key ); ?>">
                <strong><?php echo esc_html( $label ); ?></strong>
            </label><br>
            <textarea
                id="<?php echo esc_attr( $key ); ?>"
                name="<?php echo esc_attr( $key ); ?>"
                rows="2"
                style="width:100%"
            ><?php echo esc_textarea( $value ); ?></textarea>
        </p>
        <?php
    }
}

/**
 * Save meta box fields.
 */
function dice_nerdwallet_save_meta( $post_id ) {
    if ( ! isset( $_POST['dice_nerdwallet_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['dice_nerdwallet_nonce'], 'dice_nerdwallet_save_meta' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    $fields = [
        'hero_headline',
        'hero_subheadline',
        'hero_cta_text',
        'hero_cta_url',
        'hero_image',
        'author_name',
        'author_bio',
        'author_image',
        'editorial_policy',
        'cta_headline',
        'cta_trust_note',
        'disclaimer',
    ];

    foreach ( $fields as $key ) {
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta(
                $post_id,
                $key,
                sanitize_textarea_field( $_POST[ $key ] )
            );
        }
    }
}
add_action( 'save_post', 'dice_nerdwallet_save_meta' );


wp_enqueue_script(
    'dice-nerdwallet-nav',
    get_stylesheet_directory_uri() . '/js/nav.js',
    array(),
    '1.0.0',
    true
);

function dice_nerdwallet_register_menus() {
    register_nav_menus([
        'footer' => __( 'Footer Menu', 'dice-nerdwallet' ),
    ]);
}
add_action( 'after_setup_theme', 'dice_nerdwallet_register_menus' );