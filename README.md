# dice-nerdwallet

A WordPress child theme built on the Dice (_s/Underscores) parent theme, styled to match NerdWallet's visual identity. Created as a technical assessment for moveBuddha.

## Overview

This child theme powers a hypothetical "Best Financial Advisors in California" landing page, demonstrating custom WordPress development without reliance on page builders or heavy plugins.

## Technical Decisions

### Typography — Montserrat instead of Gotham
NerdWallet's production site uses Gotham, a licensed commercial typeface by Hoefler&Co. Since Gotham is not freely available, this theme uses Montserrat — a free Google Font with the same geometric sans-serif characteristics and visual weight. The substitution maintains brand fidelity without licensing concerns.

### SEO — Hand-rolled JSON-LD instead of Yoast
Rather than delegating structured data to a plugin, FAQ schema markup is registered directly via `add_action( 'wp_head' )` using WordPress-native `wp_json_encode()`. This approach demonstrates understanding of schema.org vocabulary and structured data implementation at the code level. The FAQPage schema is valid and reviewable in the page source.

### Custom Metafields — Native WordPress instead of ACF
All editable content fields (hero copy, author bio, disclaimer, etc.) are registered using `register_post_meta()` with a custom meta box UI built in PHP. No ACF or SCF dependency required. This satisfies the brief's extra credit requirement and keeps the plugin footprint minimal.

### SCSS Architecture
Styles follow a modular SCSS structure compiled via the Dart Sass CLI:
- `abstracts/` — CSS custom properties and SCSS variables
- `base/` — reset and typography
- `layouts/` — per-section styles (hero, table, trust, faq, conversion, footer, header)
- `components/` — reusable UI elements (buttons, forms)

Nested SCSS syntax is used throughout in preference to BEM naming conventions.

## Theme Structure

dice-nerdwallet/
├── functions.php        # Enqueue styles/scripts, register metafields and meta box
├── style.css            # Theme header (compiled from sass/)
├── header.php           # Custom header with responsive nav
├── page-financial-advisors.php  # Landing page template
├── single-dice.php      # Single Dice CPT template
├── dice-loop.php        # Dice CPT loop page template
├── sass/
│   ├── style.scss       # Entry point
│   ├── abstracts/       # Variables
│   ├── base/            # Reset, typography
│   ├── layouts/         # Section styles
│   └── components/      # Buttons, forms
└── js/
├── faq.js           # FAQ accordion
└── nav.js           # Mobile hamburger menu

## Plugin

The `dice-cpt` plugin (in `wp-content/plugins/dice-cpt/`) registers:
- `dice` custom post type with `thumbnail`, `author`, `editor`, and `excerpt` support
- `campaign` taxonomy attached to the `dice` post type

## Live URL

[https://wp.gilfo1.com](https://wp.gilfo1.com)