<?php
/**
 * Template Name: Financial Advisors Landing Page
 *
 * @package dice-nerdwallet
 */

// JSON-LD Structured Data
add_action( 'wp_head', function() {
    $faqs = [
        [
            'q' => 'How much does a financial advisor cost in California?',
            'a' => 'Most charge 0.25–1% of assets under management, or flat annual fees ranging $2,000–$7,500.',
        ],
        [
            'q' => 'Do I need an advisor near me?',
            'a' => 'Many clients work remotely, but some prefer face-to-face meetings in their city.',
        ],
        [
            'q' => 'What is a fiduciary financial advisor?',
            'a' => 'A fiduciary is legally required to act in your best interest, unlike brokers who only need to recommend "suitable" products.',
        ],
        [
            'q' => 'How do I verify a financial advisor\'s credentials?',
            'a' => 'Check FINRA BrokerCheck or the SEC\'s Investment Adviser Public Disclosure database to verify licenses and check for disciplinary history.',
        ],
    ];

    $faq_entities = array_map( function( $faq ) {
        return [
            '@type'          => 'Question',
            'name'           => $faq['q'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text'  => $faq['a'],
            ],
        ];
    }, $faqs );

    $schema = [
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        'mainEntity' => $faq_entities,
    ];

    echo '<script type="application/ld+json">' . wp_json_encode( $schema ) . '</script>';
} );


get_header();

// Get meta fields
$hero_headline    = get_post_meta( get_the_ID(), 'hero_headline', true );
$hero_subheadline = get_post_meta( get_the_ID(), 'hero_subheadline', true );
$hero_cta_text    = get_post_meta( get_the_ID(), 'hero_cta_text', true );
$hero_cta_url     = get_post_meta( get_the_ID(), 'hero_cta_url', true );
$hero_image = get_post_meta( get_the_ID(), 'hero_image', true );
$author_name      = get_post_meta( get_the_ID(), 'author_name', true );
$author_bio       = get_post_meta( get_the_ID(), 'author_bio', true );
$editorial_policy = get_post_meta( get_the_ID(), 'editorial_policy', true );
$cta_headline     = get_post_meta( get_the_ID(), 'cta_headline', true );
$cta_trust_note   = get_post_meta( get_the_ID(), 'cta_trust_note', true );
$disclaimer       = get_post_meta( get_the_ID(), 'disclaimer', true );
?>

<main id="primary" class="fa-landing">

    <?php // 1. HERO SECTION ?>
    <section class="fa-hero" aria-label="Hero">
        <div class="fa-container">
            <div class="fa-hero__content">
                <h1 class="fa-hero__headline">
                    <?php echo esc_html( $hero_headline ); ?>
                </h1>
                <p class="fa-hero__subheadline">
                    <?php echo esc_html( $hero_subheadline ); ?>
                </p>
                <a href="<?php echo esc_url( $hero_cta_url ); ?>" class="fa-btn fa-btn--primary">
                    <?php echo esc_html( $hero_cta_text ); ?>
                </a>
                <div class="fa-hero__trust-badges" aria-label="As seen in">
                    <span class="fa-trust-label">As Seen In:</span>
                    <span class="fa-trust-badge">Forbes</span>
                    <span class="fa-trust-badge">NerdWallet</span>
                    <span class="fa-trust-badge">Barron's</span>
                </div>
            </div>
            <div class="fa-hero__image" aria-hidden="true">

                <img 
                    src="<?php echo esc_url( get_post_meta( get_the_ID(), 'hero_image', true ) ); ?>"
                    alt="A financial advisor meeting with a client to discuss investment goals"
                    width="1280"
                    height="720"
                    loading="lazy"
                />


            </div>
        </div>
    </section>

    <?php // 2. COMPARISON TABLE ?>
    <section class="fa-table-section" aria-label="Top Financial Advisors Comparison">
        <div class="fa-container">
            <h2>Top Financial Advisors in California</h2>
            <div class="fa-table-wrap">
                <table class="fa-table" role="table">
                    <thead>
                        <tr>
                            <th scope="col">Advisor</th>
                            <th scope="col">Location</th>
                            <th scope="col">Services</th>
                            <th scope="col">Specialty</th>
                            <th scope="col">Fees</th>
                            <th scope="col">Rating</th>
                            <th scope="col">Compare</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $advisors = [
                            [
                                'name'      => 'Bay Area Wealth Management',
                                'location'  => 'San Francisco, CA',
                                'services'  => 'Retirement, Tax, Estate Planning',
                                'specialty' => 'High-net-worth families',
                                'fees'      => '1% AUM, Fee-Only',
                                'rating'    => '4.8',
                            ],
                            [
                                'name'      => 'SoCal Financial Group',
                                'location'  => 'Los Angeles, CA',
                                'services'  => 'Investment, Retirement, Insurance',
                                'specialty' => 'Young professionals',
                                'fees'      => '0.75% AUM, Fee-Only',
                                'rating'    => '4.7',
                            ],
                            [
                                'name'      => 'Pacific Fiduciary Advisors',
                                'location'  => 'San Diego, CA',
                                'services'  => 'Estate Planning, Tax, Investments',
                                'specialty' => 'Retirees',
                                'fees'      => 'Flat $5,000/yr',
                                'rating'    => '4.9',
                            ],
                            [
                                'name'      => 'Silicon Valley Wealth Co.',
                                'location'  => 'San Jose, CA',
                                'services'  => 'Stock Options, Tax, Retirement',
                                'specialty' => 'Tech employees',
                                'fees'      => '0.5% AUM, Fee-Only',
                                'rating'    => '4.6',
                            ],
                            [
                                'name'      => 'Golden State Advisors',
                                'location'  => 'Sacramento, CA',
                                'services'  => 'Retirement, Budgeting, Insurance',
                                'specialty' => 'Middle-income families',
                                'fees'      => 'Flat $3,500/yr',
                                'rating'    => '4.5',
                            ],
                        ];
                        foreach ( $advisors as $advisor ) : ?>
                        <tr>
                            <td data-label="Advisor"><strong><?php echo esc_html( $advisor['name'] ); ?></strong></td>
                            <td data-label="Location"><?php echo esc_html( $advisor['location'] ); ?></td>
                            <td data-label="Services"><?php echo esc_html( $advisor['services'] ); ?></td>
                            <td data-label="Specialty"><?php echo esc_html( $advisor['specialty'] ); ?></td>
                            <td data-label="Fees"><?php echo esc_html( $advisor['fees'] ); ?></td>
                            <td data-label="Rating">
                                <span class="fa-rating" aria-label="<?php echo esc_attr( $advisor['rating'] ); ?> out of 5">
                                    ★★★★★ <?php echo esc_html( $advisor['rating'] ); ?>/5
                                </span>
                            </td>
                            <td data-label="Compare">
                                <a href="#" class="fa-btn fa-btn--secondary fa-btn--sm">Visit Site</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <?php // 3. TRUST & AUTHORITY BLOCK ?>
    <section class="fa-trust" aria-label="Trust and Authority">
        <div class="fa-container">
            <div class="fa-trust__inner">
                <div class="fa-trust__author">
                    <div class="fa-trust__avatar" aria-hidden="true">
                        <?php 
                        $author_image = get_post_meta( get_the_ID(), 'author_image', true );
                        if ( $author_image ) : ?>
                            <img src="<?php echo esc_url( $author_image ); ?>" alt="<?php echo esc_attr( $author_name ); ?>" />
                        <?php else : ?>
                            <?php echo esc_html( substr( $author_name, 0, 1 ) ); ?>
                        <?php endif; ?>
                    </div>
                    <div class="fa-trust__author-info">
                        <strong><?php echo esc_html( $author_name ); ?></strong>
                        <p><?php echo esc_html( $author_bio ); ?></p>
                    </div>
                </div>
                <div class="fa-trust__policy">
                    <h3>Our Editorial Policy</h3>
                    <p><?php echo esc_html( $editorial_policy ); ?></p>
                </div>
            </div>
        </div>
    </section>

    <?php // 4. FAQ SECTION ?>
    <section class="fa-faq" aria-label="Frequently Asked Questions">
        <div class="fa-container">
            <h2>Frequently Asked Questions</h2>
            <?php
            $faqs = [
                [
                    'q' => 'How much does a financial advisor cost in California?',
                    'a' => 'Most charge 0.25–1% of assets under management, or flat annual fees ranging $2,000–$7,500.',
                ],
                [
                    'q' => 'Do I need an advisor near me?',
                    'a' => 'Many clients work remotely, but some prefer face-to-face meetings in their city.',
                ],
                [
                    'q' => 'What is a fiduciary financial advisor?',
                    'a' => 'A fiduciary is legally required to act in your best interest, unlike brokers who only need to recommend "suitable" products.',
                ],
                [
                    'q' => 'How do I verify a financial advisor\'s credentials?',
                    'a' => 'Check FINRA BrokerCheck or the SEC\'s Investment Adviser Public Disclosure database to verify licenses and check for disciplinary history.',
                ],
            ];
            ?>
            <div class="fa-faq__list" itemscope itemtype="https://schema.org/FAQPage">
                <?php foreach ( $faqs as $i => $faq ) : ?>
                <div class="fa-faq__item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                    <button
                        class="fa-faq__question"
                        aria-expanded="false"
                        aria-controls="faq-answer-<?php echo $i; ?>"
                        itemprop="name"
                    >
                        <?php echo esc_html( $faq['q'] ); ?>
                        <span class="fa-faq__icon" aria-hidden="true">+</span>
                    </button>
                    <div
                        class="fa-faq__answer"
                        id="faq-answer-<?php echo $i; ?>"
                        itemscope
                        itemprop="acceptedAnswer"
                        itemtype="https://schema.org/Answer"
                        hidden
                    >
                        <p itemprop="text"><?php echo esc_html( $faq['a'] ); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php // 5. CONVERSION SECTION ?>
    <section class="fa-conversion" id="get-matched" aria-label="Get Matched to an Advisor">
        <div class="fa-container">
            <h2><?php echo esc_html( $cta_headline ); ?></h2>
            <form class="fa-form" action="#" method="post" aria-label="Get matched to a financial advisor">
                <?php wp_nonce_field( 'fa_match_form', 'fa_match_nonce' ); ?>
                <div class="fa-form__fields">
                    <input type="text" name="fa_name" placeholder="Your Name" aria-label="Your Name" required />
                    <input type="text" name="fa_zip" placeholder="Zip Code" aria-label="Zip Code" required />
                    <input type="email" name="fa_email" placeholder="Email Address" aria-label="Email Address" required />
                    <input type="tel" name="fa_phone" placeholder="Phone Number" aria-label="Phone Number" />
                </div>
                <button type="submit" class="fa-btn fa-btn--primary fa-btn--full">
                    Get Free Matches
                </button>
                <p class="fa-form__trust"><?php echo esc_html( $cta_trust_note ); ?></p>
            </form>
        </div>
    </section>

</main>

<?php
get_footer();