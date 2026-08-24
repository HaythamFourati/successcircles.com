# SuccessCircles

A bespoke, server-rendered **WordPress classic theme** for [SuccessCircles](https://www.successcircles.com/) — a peer execution system and advisory community for established entrepreneurs, running since 2005.

No page builder. No ACF. No block editor gymnastics. No build step. Hand-authored PHP and CSS, with the design implemented faithfully from a prototype.

```
PHP 7.4+  ·  WordPress 6.0+  ·  GPL-2.0-or-later  ·  zero npm dependencies
```

---

## Why it's built this way

The design is bespoke and hand-tuned — `oklch()` colour, orbit keyframes, curtain radii, a clamp-based type scale. That maps poorly onto utility classes, so there is **deliberately no build pipeline**: no `package.json`, no Tailwind, no `node_modules`. One stylesheet, one script, both versioned with `filemtime()` so cache-busting is automatic.

Everything degrades without JavaScript. The FAQ accordions are native `<details>`. The nav dropdowns open on `:hover` / `:focus-within` with no JS. The Entrepreneur Test modal is a native `<dialog>` rendered server-side. The contact form posts to `admin-post.php`. Videos are click-to-play facades that load nothing from Vimeo until pressed.

---

## Requirements

| | |
| --- | --- |
| PHP | 7.4 or newer |
| WordPress | 6.0 or newer |
| Plugins | **None required.** Contact Form 7 is optional — see below. |

---

## Installation

1. Copy this directory into `wp-content/themes/` and activate it.
2. On activation the theme creates any missing `home`, `rules-for-success`, `testimonials` and `about` page, wires up **Settings → Reading** if no Posts page is set, and seeds six demo Entrepreneur Test questions. It only ever fills in blanks — nothing existing is overwritten.
3. Set your globals in **Appearance → Customize → SuccessCircles**: CTA URLs, program prices, phone, socials, contact-form recipient.

> **Note on the folder name.** During development this directory carried a trailing space (`SuccessCirclesWP `). That artifact does not survive a `git clone`, so nothing needs doing — but if you copy the theme around by hand, make sure the folder name has no trailing whitespace.

---

## Content management

A hybrid, chosen so the client edits what changes and nobody edits what doesn't.

### 1. Static copy → `inc/content.php`

One large filterable array, read with dot notation:

```php
successcircles_content( 'hero.title' );
successcircles_content( 'programs.cards.0.price', '$194' );
successcircles_content( 'faq.items', array() );
```

**To change homepage copy, edit `inc/content.php` — not the template parts.** Filter hook: `successcircles_content_tree`.

Internal links are stored relative (`#programs`, `/about/`) and resolved by `successcircles_url()`, so on-page anchors stay bare on the front page and become absolute everywhere else.

### 2. Growing content → post types

| Type | Admin label | What it is |
| --- | --- | --- |
| `post` | Posts | **The podcast.** "Rules for Success" episodes are ordinary posts — there is no separate episode type. Extra field: `_sc_role` (the guest's role). |
| `sc_question` | Entrepreneur Test | One question per post; answer options one per line; ordered by page-attributes **Order**. |
| `sc_lead` | ↳ Test Leads | Test submissions — name, answer transcript, email, phone. |

### 3. Globals → the Customizer

Panel **SuccessCircles** → Calls to action, Pricing, Contact & social. Read through `successcircles_option( $mod, $content_path, $default )`, so a Customizer value always wins over the content tree.

---

## What's in it

### The Entrepreneur Test — `inc/quiz.php`

A multi-step quiz in a native `<dialog>`, **every step rendered server-side** (there are no template strings in the JavaScript — `initQuiz()` only toggles `hidden`). Submits over `admin-ajax.php` with a nonce, a honeypot, and a one-per-minute throttle. **Answers are only trusted as far as the published question list** — anything that isn't one of that question's own options is discarded, never stored. Leads are saved as `sc_lead` posts and mailed to the site owner.

Every "Take the Entrepreneur Test" button is wired by `successcircles_test_link_attrs()`, which prints a real `href` *plus* the modal hook — so with JavaScript off the buttons still go somewhere useful.

### Contact form — `inc/contact.php`, `inc/cf7.php`

Works two ways:

- **No plugin:** the built-in form posts to `admin-post.php`, validates server-side (the form carries `novalidate`, so the server path is always the real check), and returns values through a short-lived transient so a long message survives a failed round trip. Nonce + honeypot + throttle.
- **With Contact Form 7 installed:** the theme detects it and **provisions its own form on the first render of the contact page** — fields, labels and mail template included — then renders that from then on. Nothing to paste into a page. The CF7 form template is the theme's own markup, so its output carries the same classes and needs no parallel stylesheet.

Fields in both: name, email, phone (optional), message.

### Momentum Buzz — `inc/wins.php`

The `/weekly-wins/` page runs on the live "Weekly Wins" category at successcircles.com, pulled through the public REST API — no credentials, no plugin.

**Nothing is fetched while rendering.** A daily cron job walks every page of the category and replaces one non-autoloaded option; the template only reads that option. The refresh is **all or nothing**, so a slow or dead source never empties the page. The parser earns its keep: of 614 source posts, 528 survive across 199 members, with deliberately strict title matching so site news can't leak onto the page.

### SEO and LLM discoverability — `inc/setup.php`, `inc/schema.php`, `inc/llms.php`

The theme owns its SEO, and **self-disables cleanly** if Yoast, Rank Math or SEOPress is ever installed.

- **One description resolver** feeds the meta description, Open Graph, Twitter cards and schema, so they can never disagree. Pages whose copy lives in the content tree get theirs mapped by slug.
- **One connected JSON-LD `@graph` per page** — `Organization`, `WebSite`, `Person`, a typed `WebPage`, `BreadcrumbList`, `Service` + `Offer` for both programs, and `BlogPosting` on articles. Nodes cross-reference by `@id` rather than repeating themselves.
- **Canonical URLs on every view** (WordPress core only emits them on singular views), plus `noindex` on search, 404s and paginated duplicates.
- **`/llms.txt` and `/llms-full.txt`**, generated from the content tree and published posts — a new episode appears the moment it's published. `robots.txt` names the AI crawlers explicitly.

Review markup deliberately carries **no `reviewRating`**: the source testimonials have no ratings, and inventing them would be fabricated markup. It exists for entity comprehension, not for star ratings.

### The article page — `single.php`

Built as a document rather than a text dump, because these interviews run 3,000–6,000 words: an asymmetric masthead, a contents rail that `theme.js` builds from the headings the editor actually wrote, a reading-progress hairline, and a 58ch measure.

---

## Layout

```
functions.php              thin bootstrap; requires inc/*
style.css                  theme header only — no rules live here

inc/
  setup.php                theme supports, menus, meta description, OG, canonical, robots
  schema.php               the JSON-LD @graph
  llms.php                 /llms.txt, /llms-full.txt, robots.txt
  enqueue.php              fonts + one stylesheet + one script, filemtime() versioning
  content.php            ★ all static copy, as a PHP array tree
  template-tags.php        successcircles_content(), _url(), _nav_list(), _episodes(), …
  customizer.php           CTA URLs, prices, phone, socials, form recipient
  contact.php              built-in contact form handler
  cf7.php                  Contact Form 7 detection + auto-provisioning
  quiz.php               ★ the Entrepreneur Test
  wins.php               ★ live Weekly Wins pull + daily cron
  post-types.php           _sc_role meta, activation setup

assets/
  css/main.css           ★ the entire design system (~3,700 lines)
  js/theme.js              loader, mobile drawer, video facades, contents rail, quiz
  img/

template-parts/
  home/                    the 12 homepage sections, in order
  site-header.php  site-footer.php  quiz-modal.php  film.php  episode-grid.php  …

front-page.php  home.php  single.php  page-*.php  index.php  404.php
docs/                      the original Claude Design handoff note, kept for provenance
refrence files/            the design prototype (read-only; the folder name's misspelling
                           is original and load-bearing in the docs)
```

★ = the files you'll spend the most time in.

**`CLAUDE.md` is the full project memory** — architecture decisions, the reasoning behind them, gotchas, and open items. Read it before making changes.

---

## Design system

**Colour** is all `oklch()`, with components stored bare so alpha composes cleanly (`--sc-ink-c: 0.19 0.012 60` → `oklch(var(--sc-ink-c) / 0.7)`). Accent rule: rust on light bands, amber on dark — `.sc-accent` swaps automatically inside `.sc-band--dark`.

**Type** is three families: Newsreader (display), Public Sans (body/UI), JetBrains Mono (eyebrows, prices, metadata). Display headings are always weight 400 with negative tracking — never bold them.

**Layout** is `repeat(auto-fit, minmax(min(100%, Npx), 1fr))` throughout rather than breakpoints. The only real media queries are the 1180px header collapse, a 760px small-screen block, and `prefers-reduced-motion`.

**Band rhythm matters.** Dark sections are followed by light sections carrying `.sc-band--curtain`, which lifts the light panel over the dark one with a negative top margin. Reordering sections means re-checking which need `--curtain` versus `--hairline`.

---

## Development

There is no build step. Edit the PHP and the CSS directly.

```bash
# Lint every PHP file
for f in $(find . -name '*.php' -not -path './refrence files/*'); do
  php -l "$f" | grep -v 'No syntax errors'
done; echo "LINT DONE"

# Render and check for PHP notices (warnings are wrapped in <b> tags)
curl -s http://your-site.local/ > /tmp/sc.html
grep -cE '<b>(Warning|Notice|Deprecated|Fatal error)</b>' /tmp/sc.html

# Heading hierarchy — must be exactly one h1
grep -oE '<h[1-6]' /tmp/sc.html | sort | uniq -c
```

### Conventions

- Prefix everything: `successcircles_` for PHP, `sc-` for CSS classes, `$sc_` for template variables.
- Tabs for indentation (WordPress coding standards).
- Every file opens with `defined( 'ABSPATH' ) || exit;` and a docblock.
- Escape on output: `esc_html()`, `esc_url()`, `esc_attr()`; `successcircles_inline()` for strings that legitimately contain inline markup.
- One `<h1>` per page. Sections use `<h2>` with `aria-labelledby`. Decorative elements get `aria-hidden="true"`.
- **Don't register a widget area** — WordPress auto-populates the first registered sidebar, which injects stray `<h2>`s and breaks the heading hierarchy.

---

## Credits

Design implemented from the *SuccessCircles 2026 Website Redesign* prototype. Fonts are [Newsreader](https://fonts.google.com/specimen/Newsreader), [Public Sans](https://fonts.google.com/specimen/Public+Sans) and [JetBrains Mono](https://fonts.google.com/specimen/JetBrains+Mono), served from Google Fonts.

## License

GPL-2.0-or-later, matching WordPress. See the header in `style.css`.
