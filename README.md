# Agenio Personal WP System

This package contains a first professional WordPress conversion scaffold for the `Juvempire/html-template` Agenio HTML template.

It is built for one personal English business website focused on WordPress web design, SEO, digital marketing, technical SEO, performance and lead generation.

## What is included

- `wp-content/themes/agenio-personal` — custom Classic WordPress theme.
- `wp-content/plugins/agenio-core` — functionality plugin for CPTs, settings, SEO fallback, contact form, performance and white label controls.

## What is intentionally not included

- No demo importer.
- No Elementor.
- No page builder.
- No Gutenberg block dependency.
- No marketplace/license system.
- No client-role restriction system.

## Important note about original assets

The execution environment could not clone GitHub directly, so this first package contains the WordPress architecture and a lightweight CSS/JS foundation. To fully preserve the visual design of the original HTML template, copy the original folder:

```text
html-template/agenio/assets
```

into:

```text
wp-content/themes/agenio-personal/assets/original
```

Then the theme can be extended to enqueue the original CSS/JS files selectively.

## Installation

1. Copy `agenio-personal` into `wp-content/themes/`.
2. Copy `agenio-core` into `wp-content/plugins/`.
3. Activate the `Agenio Core` plugin.
4. Activate the `Agenio Personal` theme.
5. Go to **Agenio → Settings** and configure branding, SEO, contact and performance.
6. Create services, case studies, testimonials, FAQs and process steps from the WordPress admin.
7. Set a static homepage in **Settings → Reading**.

## Suggested first pages

- Home
- About
- Services
- Case Studies
- Blog
- Contact

## Suggested primary CTA

Use one of these:

- Book a Free Consultation
- Request a Free Website Audit
- Start Your Project

## Rank Math compatibility

The built-in SEO output is designed to disable itself when Rank Math is detected, preventing duplicate meta tags, Open Graph tags, canonical links and schema.

## Main architecture

```text
Classic Theme = presentation, templates, components, assets
Core Plugin   = CPTs, settings, SEO fallback, contact form, white label
```
