# CLAUDE.md — SuccessCircles WordPress Theme

Project memory for coding agents. Read this before touching anything.

> **Note:** `README.md` is now **ours** — a real project README written for the public
> GitHub repo (2026-08-24). The original Claude Design handoff note that shipped with the
> design bundle was moved to `docs/claude-design-handoff.md` and kept for provenance;
> don't rewrite *that* one. This file (`CLAUDE.md`) remains the project memory: the README
> is the public front door, CLAUDE.md is the working detail.

---

## 1. What this is

A **bespoke, server-rendered WordPress classic theme** for SuccessCircles — a peer
execution system and advisory community for established entrepreneurs (founded 2005).

It is a faithful implementation of a Claude Design prototype ("SuccessCircles 2026
Website Redesign"). The prototype is the **source of truth for visual design and copy**.

**Status:** complete and active on the local site. Homepage, page, single, archive,
search, 404 all render without errors.

---

## 2. Critical environment gotchas

| Gotcha | Detail |
| --- | --- |
| **Theme folder has a trailing space** | The directory is literally `SuccessCirclesWP ` (note the space before the closing quote). URLs encode it as `%20`. **Always quote paths in shell commands.** `cd`-less tool calls must pass the exact path including the space. |
| **Reference folder is misspelled** | It is `refrence files/` (missing the `e`), not `reference files/`. |
| **`refrence files/` is read-only** | Never modify, move or delete anything inside it. Images were **copied** out into `assets/img/`, never moved. |
| **Local site URL** | `http://successcircles.local/` — Local by Flywheel. Site root: `/Users/haythamfourati/Local Sites/successcircles/app/public/` |
| **No build step** | Deliberate decision. No `package.json`, no npm, no Tailwind, no `node_modules`. Plain hand-authored CSS. Do not introduce a build pipeline without asking. |

The user's global rules describe a Tailwind v4 + `@wordpress/scripts` + BrowserSync stack.
**That does not apply to this project** — it was explicitly overridden. The design is
bespoke hand-tuned CSS (oklch values, orbit keyframes, curtain radii) that maps poorly
onto utility classes. The user chose "Plain CSS, no build step".

---

## 3. Reference / design source

```
refrence files/
├── SuccessCircles Homepage.dc.html   # THE design. 634 lines. All inline styles.
├── support.js                        # Claude Design React runtime (DCLogic). Prototype
│                                     # harness only — nothing to port. Ignore it.
├── cc-hero-smushed-msxna2d4-pcew.jpg # hero image (1267x713)
├── assets/
│   ├── successcircles-logo.png       # 195x78
│   └── story-poster.png              # 1914x1075, 2.5MB (unoptimised)
└── uploads/                          # misc brand assets, not used by the theme
```

The `.dc.html` file uses prototype-only pseudo-elements you must translate, not copy:

- `<x-dc>`, `<helmet>` — prototype wrappers
- `<sc-if value="{{ wide }}">` — conditional blocks; became CSS media queries
- `{{ buddyPrice }}`, `{{ loaderMark }}` — template values; became Customizer settings
  and `successcircles_brand_mark()`
- `style-hover="…"` — hover styles; became real CSS `:hover` rules

---

## 4. File map

```
CLAUDE.md                      # this file
README.md                      # public GitHub README (ours)
.gitignore                     # macOS/editor noise; node_modules guarded on principle
docs/claude-design-handoff.md  # the original Claude Design handoff note (do not rewrite)
style.css                      # theme header ONLY — no rules live here
functions.php                  # thin bootstrap, requires inc/*

inc/
├── setup.php                   # theme supports, nav menus, image sizes,
│                               # meta description + Open Graph fallbacks, body_class
├── enqueue.php                 # fonts + main.css + theme.js, filemtime() versioning,
│                               # resource hints, defer filter
├── content.php                 # ★ ALL homepage copy as a PHP array tree
├── template-tags.php           # helpers: successcircles_content(), _eyebrow(), _logo(),
│                               # _nav_list(), _image(), _brand_mark(), _testimonials(),
│                               # _episodes(), _pagination(), _inline()
├── post-types.php              # _sc_role meta, activation setup (no CPTs left)
├── customizer.php              # sc_panel: CTA URLs, prices, phone, socials, form recipient
├── contact.php                 # contact form: admin-post handler, validation, wp_mail()
├── quiz.php                    # ★ Entrepreneur Test: sc_question + sc_lead CPTs,
│                               #   admin-ajax handler, modal render, seed questions
└── wins.php                    # ★ live Weekly Wins pull from successcircles.com REST,
                                #   daily cron into one option; drives the testimonials page

assets/
├── css/main.css                # ★ the entire design system (~3600 lines)
├── js/theme.js                 # loader removal, mobile drawer, video facade
└── img/
    ├── hero-huddle.jpg         # copied from refrence files/
    ├── story-poster.png        # copied from refrence files/assets/
    └── successcircles-logo.png # copied from refrence files/assets/

header.php                     # doctype, preconnects, skip link, loader, site-header
footer.php                     # closes main, site-footer, wp_footer
front-page.php                 # homepage — calls the 12 home template parts in order
page.php                       # generic page
page-about.php                 # auto-used for slug "about"; keep id="corevalues" on the
                               #   values section for inbound links to the old anchor
page-about-joseph-varghese.php # auto-used for slug "about-joseph-varghese"
page-testimonials.php          # auto-used for slug "testimonials"; 11 member films + 8 quotes
page-weekly-wins.php           # auto-used for slug "weekly-wins"; the live Momentum Buzz feed
page-faq.php                   # auto-used for slug "faq"; grouped <details> + FAQPage JSON-LD
page-contact-us.php            # auto-used for slug "contact-us"; channels + working form
home.php                       # ★ the blog — Posts page "Rules for Success"
single.php                     # ★ the article — masthead, contents rail, prose
index.php                      # fallback: archives, search results
404.php
searchform.php
comments.php

template-parts/
├── loader.php                 # curtain + orbit brand mark
├── site-header.php            # sticky header, desktop nav + compact drawer
├── site-footer.php            # brand, 3 link columns, legal bar
├── content-card.php           # archive listing card
├── film.php                   # click-to-play Vimeo facade (testimonials page)
├── quiz-modal.php             # Entrepreneur Test <dialog>: every step, server-rendered
├── episode-grid.php           # shared .sc-episode card grid (home + blog + article)
└── home/
    ├── hero.php     trust.php     problem.php   system.php
    ├── programs.php process.php   stories.php   test.php
    └── founder.php  podcast.php   faq.php       cta.php
```

★ = the two files you'll edit most.

---

## 5. Homepage section order

Defined in `front-page.php`. Numbering matches the design's eyebrow labels.

| # | Part | Band | Notes |
| --- | --- | --- | --- |
| — | `hero` | sand | The page's **only `h1`**. Orbit rings + circular photo + "Today's huddle" badge. Staggered `scRise` entrance. |
| — | `trust` | **dark** | "As seen in": Inc., Trustpilot, Michael Gerber, Blair Singer. |
| 01 | `problem` | shade + curtain | 4 numbered rows. |
| 02 | `system` | **dark** | Momentum OS. Formula strip + 6-cell bordered grid (Clarify → Compound). |
| 03 | `programs` | sand + curtain | 2 cards (Buddy $194, Labs $97) + 3-col includes strip. |
| 04 | `process` | shade + hairline | 4 timeline steps. |
| 05 | `stories` | sand | Vimeo facade + large pull-quote + 2 testimonials. |
| 06 | `test` | **dark** | Entrepreneur Test CTA band. |
| 07 | `founder` | sand + curtain | Joseph JV Varghese, portrait + signature. |
| 08 | `faq` | **shade + hairline** | 4 Q&A + FAQPage JSON-LD. |
| — | `cta` | sand + hairline | "Dare to play a bigger game." `id="contact"`. Primary button opens the test. |

**The podcast section was removed from the homepage on 2026-08-31** (`template-parts/home/podcast.php`
is still in the tree, just no longer included by `front-page.php`; the blog itself is
untouched at `/rules-for-success/`). Two things had to move with it: the FAQ was renumbered
09 → 08 so the eyebrow sequence has no gap, and the FAQ took over the **shade + hairline**
band, because podcast carried the only tonal break between the founder band and the closing
CTA — without it, founder / FAQ / CTA ran together as one unbroken sand field.

**The band rhythm matters.** Dark sections are followed by light sections carrying
`.sc-band--curtain`, which applies `border-radius: clamp(30px,4vw,60px) … 0 0` plus a
negative top margin so the light panel lifts over the dark one. Don't reorder sections
without re-checking which ones need `--curtain` vs `--hairline`.

---

## 6. Design system

### Colour — all oklch

Components are stored **bare** so alpha composes cleanly:

```css
--sc-ink-c: 0.19 0.012 60;        /* → oklch(var(--sc-ink-c) / 0.7) */
--sc-cream-c: 0.965 0.012 85;
--sc-orange-c: 0.72 0.19 47;
--sc-amber-c: 0.76 0.185 48;      /* accent on DARK bands */
--sc-amber-soft-c: 0.72 0.16 50;
--sc-glow-c: 0.62 0.17 48;
```

Solid tokens: `--sc-sand` `#f7f4ee`-ish `oklch(0.975 0.012 85)`, `--sc-sand-shade`
`oklch(0.955 0.014 85)`, `--sc-sand-warm` (featured program card), `--sc-ink`,
`--sc-ink-deep` (button text), `--sc-orange` / `--sc-orange-dark` / `--sc-orange-light`,
`--sc-rust` `oklch(0.485 0.165 47)` (accent on LIGHT bands), `--sc-amber`.

**Accent rule:** `--sc-rust` on light backgrounds, `--sc-amber` on dark. `.sc-accent` and
`.sc-eyebrow__index` swap automatically inside `.sc-band--dark`.

### Type

| Token | Family | Used for |
| --- | --- | --- |
| `--sc-font-display` | Newsreader (serif, optical sizing) | all display headings, program/episode titles, pull-quotes |
| `--sc-font-body` | Public Sans | UI, body copy, row titles |
| `--sc-font-mono` | JetBrains Mono | eyebrows, prices, metadata, captions, footer legal |

Display scale: `.sc-display--hero` (clamp 46→82px) / `--xl` / `--lg` / `--md` / `--sm`.
All share `font-weight: 400` and negative tracking. **Never bold a display heading** —
the design relies on Newsreader at 400 with tight letter-spacing.

### Layout

`--sc-wrap: 1280px`, `--sc-gutter: clamp(20px,4vw,40px)`, `--sc-radius: 2px` (buttons are
almost square — this is intentional), `--sc-curtain`, `--sc-curtain-pull`.

Responsive strategy is **`repeat(auto-fit, minmax(min(100%, Npx), 1fr))`** throughout, not
breakpoints. The only real media queries are the **1180px** header collapse, a 760px
small-screen block, and `prefers-reduced-motion`.

The header breakpoint is 1180px (not the prototype's 1024px) because the full 7-item nav
plus Member Login plus a non-wrapping CTA needs ~1166px. **`theme.js` hardcodes the same
1180px** in its `matchMedia` drawer-close check — change both together.

### Motion

`scRise` (staggered entrance, delays set inline via `--sc-rise-delay`), `scOrbit` /
`scOrbitRev` (decorative rings), `scCurtain` (loader exit), `scLoadMark`, `scLoadLabel`,
`scDotPulse`, `scMarkCore`. All disabled under `prefers-reduced-motion`, where the loader
is `display: none` entirely.

---

## 7. Content management architecture

Decided with the user. **Hybrid — no ACF, no page builder, no plugins.**

### a) Static copy → `inc/content.php`

One big filterable array. Read with dot notation:

```php
successcircles_content( 'hero.title' );
successcircles_content( 'programs.cards.0.price', '$194' );
successcircles_content( 'faq.items', array() );
```

Filter hook: `successcircles_content_tree`.

**To change homepage copy, edit `inc/content.php` — not the template parts.**

### b) Growing content → CPTs

| Type | Menu label | Fields |
| --- | --- | --- |
| `post` | Posts | ordinary blog post + `_sc_role` (guest role on the card) |
| `sc_question` | Entrepreneur Test | title = question, `_sc_options` (one answer per line), Order |
| `sc_lead` | ↳ Test Leads | title = name, content = answer transcript, `_sc_email`, `_sc_phone` |

**The blog is the podcast.** Rules for Success episodes are ordinary WordPress `post`s —
there is no `sc_episode` CPT (it was removed: two content streams for one thing rots).
The listing is the WordPress **Posts page**, a page with the slug `rules-for-success`
assigned in Settings → Reading, rendered by `home.php`. Single posts use `single.php`.

`successcircles_episodes( $limit )` returns the latest posts; it returns an **empty array**
when nothing is published, and the homepage podcast section returns early rather than
rendering placeholder cards that point off-site.

`successcircles_testimonials()` falls back to the designed copy in `inc/content.php` when
no `sc_testimonial` posts exist, and orders by the page-attributes **Order** field.
`sc_testimonial` is `public => false` (admin UI only — it has no standalone page).

**On theme activation** (`successcircles_activate()` in `inc/post-types.php`) the theme
creates any missing `home` / `rules-for-success` / `testimonials` / `about` page and, if no
Posts page is set, wires up Settings → Reading. It only fills in blanks.

### c) Globals → Customizer

Panel **"SuccessCircles"** → sections: Calls to action (`sc_test_url`, `sc_apply_url`,
`sc_login_url`), Pricing (`sc_buddy_price`, `sc_labs_price`), Contact & social
(`sc_phone`, `sc_contact_email`, `sc_social_*`).

Read via `successcircles_option( $mod, $content_path, $default )` — Customizer value wins,
then content tree, then default. Convenience wrappers: `successcircles_test_url()`,
`successcircles_apply_url()`, `successcircles_login_url()`,
`successcircles_program_price( $index, $default )`, `successcircles_social_url( $social )`.

`sc_test_url` accepts a full URL **or** an on-page anchor like `#test` — see
`successcircles_sanitize_link()`.

### e) The Momentum Buzz page → live Weekly Wins (`inc/wins.php`)

**There is no testimonials post type and nothing to curate in the admin.** `/weekly-wins/`
(`page-weekly-wins.php`, content block `buzz`) runs
on the live `successcircles.com` "Weekly Wins" category (Momentum Buzz / member BRAGs),
pulled through the public REST API — no credentials, no plugin.

**Nothing is ever fetched while rendering.** A daily cron job (`sc_refresh_wins`) walks
every page of the category and replaces one non-autoloaded option (`sc_wins`, ~125KB);
the template only reads that option. The refresh is **all or nothing** — a failure part
way through returns a `WP_Error` and leaves the previous cache intact, so a slow or dead
source site never empties the page. `sc_wins_cat` caches the resolved category id,
`sc_wins_synced` the timestamp shown in the page's provenance line.

Filter hooks: `successcircles_wins_source` (site root), `successcircles_wins_category`
(slug), `successcircles_wins_max_pages` (runaway guard, default 12).

**The source data is not tidy** — `successcircles_wins_parse()` earns its keep:

- Of 614 posts, **528 survive**; 199 distinct members. The 86 dropped are mostly genuine
  non-testimonials ("Holiday Party at St. Marks Comedy Club", "Happy Valentines 2024").
  Only ~8 are salvageable typo titles (`weeky wins`, `big wins`) — the strict
  `^weekly wins?` guard is deliberate, because loosening it lets site news onto the page.
- Bodies under 10 characters are dropped (~1 in 12 posts is empty).
- Titles vary: `Weekly Wins of Pete`, `Weekly Wins Tinah Jan 12`, `Rahul Bohara last
  Feb 5`, `Joseph Varghese on August 4`. The name is stripped of its trailing date and
  connector words in a loop until it stops shrinking.
- **The separator before the month is required.** Without it the date pattern eats any
  name that merely *starts* with a month's letters — Marjah, Marc, Marianne, Marybeth
  and Martin all silently vanished. Do not "simplify" that `[\s,–—-]+` back to `\s*`.

The page paginates 36 to a view via a **`?wins=N` query arg**, not `/page/2/`: this is a
static page, so the pretty pagination rewrite belongs to the posts page and would 404.
Page 1 carries the opener and the newest win as its lead quote; later pages are wall
only. The wall band is `--hairline`, **not** `--curtain` — the curtain radius and its
negative pull only make sense lifting a light band over a dark one, and there is no dark
band on this page since the roll call was removed.

The **homepage stories section stays on curated copy** in `inc/content.php` by design —
nothing from the live feed can reach the homepage's most-read section without review.
`successcircles_testimonials()` now just reads the content tree.

### f) The Testimonials page → transcribed, not live (`page-testimonials.php`)

`/testimonials/` is a **different page from Momentum Buzz** and deliberately not live.
Its content is the `testimonials` block of `inc/content.php`, scraped once from
`successcircles.com/testimonials/` (a Divi page — the quotes sit across paired
`et_pb_blurb` + `et_pb_text` modules, with the attribution on a `~ Name, Role` line):

- **11 member films.** The live page renders bare Vimeo iframes with no labels, so the
  names, durations and poster frames came from **Vimeo's oEmbed endpoint**
  (`vimeo.com/api/oembed.json?url=…&width=1280`) — no API key. Posters are saved locally
  in `assets/img/testimonials/{video-id}.jpg` (688KB total) so the page has no
  third-party image dependency.
- **8 written testimonials** with names and roles.

Every film is a **click-to-play facade** (`template-parts/film.php`) reusing the same
`data-sc-video` contract as the homepage story video — `initStoryVideo()` in `theme.js`
replaces the button with the iframe inside its parent. **Nothing is requested from Vimeo
until the visitor presses play.** Do not swap these for plain iframes.

### g) The Joseph Varghese page (`page-about-joseph-varghese.php`)

Slug `about-joseph-varghese` — **the live site's slug**, kept so the nav survives the
migration. Copy is the `founder_page` block in `inc/content.php`, transcribed verbatim
from `successcircles.com/about-joseph-varghese/`: three chapters, a roles line and the
pull-quote. Images live in `assets/img/about/`.

The portrait is a **transparent cut-out PNG**, which is why the opener sits on a dark
band with a radial glow ring behind the figure and no frame or radius on the image. Drop
it onto a light band and the cut-out stops working.

### Nav dropdowns

Two nav items are dropdowns, both matching the live site's own menu:

| Parent | Children |
| --- | --- |
| Success Stories | Testimonials `/testimonials/` · Momentum Buzz `/weekly-wins/` |
| About | Core Values `/about/` · Joseph Varghese `/about-joseph-varghese/` · FAQ `/faq/` |

**FAQ is no longer a top-level nav item** — it folded under About, as it is on the live
site. `/faq/` itself is unchanged.

"Core Values" is **not a separate page** — the live site has no core-values URL, so the
nav item points at plain `/about/`, where the values section is. It pointed at
`/about/#corevalues` until 2026-08-24; the anchor was dropped from the nav because the
URL read badly, but **`page-about.php` still carries `id="corevalues"`** so inbound links
to the old anchor keep working. Note this makes the "Core Values" child link the same URL
as its own "About" parent. Fallback links in the
content tree may carry a `children` array; `successcircles_nav_list()` renders it as
`.sc-subnav`, opened by `:hover` / `:focus-within` with **no JavaScript**, and as a plain
indented list in the mobile drawer. `wp_nav_menu` runs at `depth => 2` so an
admin-assigned menu can do the same.

### d) Menus

Locations: `primary`, `footer_programs`, `footer_explore`, `footer_company`.
`successcircles_nav_list( $location, $fallback_links, $args )` uses `wp_nav_menu()` when a
menu is assigned, else renders the hardcoded design links. Assigning a menu in the admin
silently takes over.

---

## 8. Conventions to follow

- **Internal links in `inc/content.php` are stored relative** — either an on-page anchor
  (`#programs`) or a root-relative path (`/about/`). `successcircles_link_url()` resolves
  them: anchors stay bare on the front page and become `home_url('/') . '#anchor'`
  everywhere else, paths expand against `home_url()`. **Print link hrefs with
  `successcircles_url()`, not `esc_url()`**, or anchors will break on inner pages.
  `successcircles_test_url()` / `_apply_url()` / `_login_url()` already resolve internally.
- **Prefix everything** `successcircles_` (PHP functions) / `sc-` (CSS classes) /
  `$sc_` (template variables, to avoid clobbering globals).
- **Escaping:** `esc_html()` for text, `esc_url()` for URLs, `esc_attr()` for attributes.
  For strings that legitimately contain inline markup (`<em>`, `<br>`, `<span class>`) use
  `successcircles_inline()`, which is `wp_kses()` with a tight allowlist. Those call sites
  carry a `phpcs:ignore WordPress.Security.EscapeOutput` comment.
- **`esc_html()` does not double-encode.** WordPress passes `$double_encode = false`, so
  `&copy;`, `&nbsp;`, `&mdash;` in `inc/content.php` survive intact. Verified in output.
  `wp_specialchars_decode()` before `esc_html()` is used to normalise `&amp;` → `&`.
- **No inline `style` dumps.** The only inline styles remaining are genuine per-instance
  custom-property values (`--sc-rise-delay`, `--sc-dot-alpha`, `--sc-ring-dur`,
  `--sc-spoke-angle`). Everything else belongs in `main.css`.
- **Tabs for indentation** in PHP and CSS (WordPress coding standards).
- **Every file** starts with `defined( 'ABSPATH' ) || exit;` and a docblock.
- **Decorative elements** get `aria-hidden="true"`. Numbered indices in lists are
  decorative (the `<ol>` conveys order) — hide them.
- **One `h1` per page.** Sections use `h2` + `aria-labelledby`. Footer column headings are
  `h2`. Cards/rows are `h3`.
- **Do not register a widget area.** WordPress auto-populates the first registered sidebar
  with default Archives/Categories widgets, which injected stray `h2`s into the footer and
  broke the heading hierarchy. The design has no footer widgets. This was removed
  deliberately.

---

## 9. SEO implementation

Three files: `inc/setup.php` (the meta layer), `inc/schema.php` (structured data) and
`inc/llms.php` (the LLM-facing routes). **The theme owns SEO — no plugin.** Every one of
these functions still self-disables behind `successcircles_seo_plugin_active()` when
Yoast (`WPSEO_VERSION`), Rank Math or SEOPress is detected. Keep that guard if you
extend them.

### The meta layer (`inc/setup.php`)

- `add_theme_support( 'title-tag' )` — never hardcode `<title>`.
- **`successcircles_seo_description()` is the one resolver.** The meta description, the
  `og:`/`twitter:` descriptions and the schema `description` all read from it, so they
  can never disagree. Most of this theme's pages carry **no post content** — their copy
  lives in `inc/content.php` — so `get_the_excerpt()` came back empty and six pages had
  no description at all. `successcircles_seo_description_paths()` maps page slug →
  content-tree path (`about` → `about.lede`, `faq` → `faq_page.lede`, …) and fills that
  gap. Filter: `successcircles_seo_descriptions`. **Adding a page means adding a line to
  that map**, or it ships with no description.
- `successcircles_canonical()` **replaces core's `rel_canonical`**, which only fires on
  singular views and left the Posts page and archives without one. Ours covers every
  view and keeps `?wins=N` (real pagination) while dropping tracking and form-status args.
- `successcircles_robots()` on the core `wp_robots` filter: `noindex, follow` for search,
  404s, `?sc-contact=`/`?sc-token=` round trips and Buzz pages 2+; `max-snippet:-1` and
  `max-video-preview:-1` everywhere else so AI Overviews may quote in full.
  **Values must be strings** — core's `wp_robots()` only renders `key:value` for strings
  and prints a bare `max-snippet` for an integer.
- Open Graph now carries `og:description`, `og:locale`, image dimensions and alt, and
  `article:published_time`/`modified_time`/`author` on posts, plus real `twitter:title`
  / `description` / `image`. `og:url` uses the canonical (it previously used
  `home_url( add_query_arg( array() ) )`, which doubles the path on a subdirectory
  install and leaked query args).

### Structured data (`inc/schema.php`)

**One connected `@graph` per page, in the head.** The three old body-level JSON-LD blocks
(FAQPage ×2, ContactPage) are gone — do not add a fourth in a template.

Sitewide nodes: `Organization` (+`WebSite`, +`Person` for the founder — emitted on
**every** page, because `Organization.founder` points at it sitewide and a reference that
resolves nowhere is worse than none). Then a typed `WebPage` per template
(`AboutPage` / `ContactPage` / `FAQPage` / `CollectionPage` / `ItemPage` /
`SearchResultsPage`), a `BreadcrumbList`, the two programs as `Service` + `Offer` on the
front page, an `ItemList` of episodes on the blog index, and `BlogPosting` on `single.php`.

- **The address and phone are no longer hardcoded.** `content.org` holds the canonical
  machine-readable org facts (founding date, phone, structured `PostalAddress`); the
  visible `contact.channels` stay display copy. Schema reads `org`.
- Prices, socials and phone go through `successcircles_program_price()`,
  `successcircles_social_url()` and `successcircles_option()`, so a Customizer override
  is reflected in the markup as well as on screen.
- **`successcircles_schema_text()` uses `html_entity_decode()`, not
  `wp_specialchars_decode()`** — the content tree is full of `&mdash;` and `&rsquo;`,
  which the latter leaves untouched. This bit once; don't undo it.
- **Reviews carry no `reviewRating` on purpose.** The source quotes have no ratings and
  inventing them would be fabricated markup. Consequence: **these will not produce star
  ratings in Google.** They hang off the `Service` nodes, not `Organization`, where
  self-collected reviews are ineligible anyway. Real rich-result stars need genuinely
  collected ratings (the Trustpilot profile in the trust band is the obvious source).
- Filter: `successcircles_schema_graph`.

### llms.txt (`inc/llms.php`)

`/llms.txt` (index) and `/llms-full.txt` (the whole site as prose) are **generated from
`inc/content.php` and the published posts** — a new episode appears the moment it is
published, there is no file to update. `/llms.txt` reuses
`successcircles_seo_description_paths()`, so a page's one-line summary is the same there
as in its meta description.

**Routing matches `REQUEST_URI`, deliberately not `add_rewrite_rule`**: the theme's only
`flush_rewrite_rules()` runs on `after_switch_theme` (`inc/post-types.php`), so a rewrite
added here would silently 404 on an already-active theme until someone re-saved the
permalink settings. Matching the path needs no flush and no activation step — the same
instinct as `?wins=N`.

`successcircles_episodes()` returns **card-field arrays, not `WP_Post`** — the transcripts
in `llms-full.txt` query posts directly because those arrays carry no body text.

`robots_txt` filter adds explicit `Allow` blocks for the named AI crawlers (GPTBot,
ClaudeBot, PerplexityBot, Google-Extended, …), disallows the form round-trip URLs and
points at both llms files. **Guarded on `blog_public`** so a staging site set to
discourage crawlers stays discouraged.

### Everywhere

- All images carry alt text and intrinsic `width`/`height` (real file dimensions) for CLS.
- Hero image is `fetchpriority="high"`, everything else `loading="lazy"`.
- `wp-sitemap.xml` is core's, untouched — it already excludes `sc_question` / `sc_lead`
  (both `public => false`).

## 10. Performance implementation

**The article page** (`single.php`) is built as a document, not a text dump — these
interviews run 3,000–6,000 words with a dozen numbered sub-sections:

- **Masthead** is asymmetric: title and guest role left, a mono `<dl>` of published /
  read time / format right, then the artwork plate full width under a hairline.
- **Contents rail** is a `<details>` element that `theme.js` fills from the `h2`/`h3`
  headings the editor actually wrote, assigning ids as it goes. It opens automatically
  at ≥1100px (sticky) and stays a disclosure below that. Fewer than three headings and
  it never appears. Without JavaScript it stays `hidden` and the prose takes the full
  measure — the same progressive-enhancement contract as the rest of the theme.
- **Reading progress** is a 2px hairline on the bottom edge of the sticky header,
  rendered only on `is_singular('post')`, scaled with a CSS custom property from a
  rAF-throttled scroll handler.
- **`.sc-prose--article`** overrides the shared prose styles for long-form: display-face
  lede paragraph, ruled `h2`, `h3` with a 22px rust rule above, dash-marked lists,
  display-face pull-quotes. Measure is 58ch (≈70 characters), not `.sc-prose`'s 68ch.
- Closes with two neighbouring interviews via the shared episode grid, then the CTA band.

- One stylesheet, one script. Script is deferred via `script_loader_tag` filter.
- `successcircles_asset_version()` uses `filemtime()` so cache-busting is automatic.
- Google Fonts preconnected in `header.php`; `fonts.gstatic.com` also added via
  `wp_resource_hints`.
- **Vimeo is a facade.** `template-parts/home/stories.php` renders a poster + button; the
  iframe is injected by `theme.js` only on click. No third-party player or cookies on load.
  Video ID: `870306260`.
- Loader element is removed from the DOM on `animationend` (3s `setTimeout` safety net).

---

## 11. Verification commands

```bash
# Always quote the path — trailing space!
cd "/Users/haythamfourati/Local Sites/successcircles/app/public/wp-content/themes/SuccessCirclesWP "

# Lint every PHP file
for f in $(find . -name '*.php' -not -path './refrence files/*'); do
  php -l "$f" | grep -v 'No syntax errors'
done; echo "LINT DONE"

# Render + check for PHP notices
curl -s http://successcircles.local/ > /tmp/sc.html
grep -iEo '(Fatal error|Warning:|Notice:|Deprecated:)[^<]{0,160}' /tmp/sc.html

# Heading hierarchy — must be exactly 1 h1
grep -oE '<h[1-6]' /tmp/sc.html | sort | uniq -c

# Route smoke test
for p in "/" "/?s=momentum" "/rules-for-success/" "/nope/"; do
  printf '%s %s\n' "$(curl -s -o /dev/null -w '%{http_code}' "http://successcircles.local$p")" "$p"
done
```

No `wp-cli` on this machine. To query or edit the DB, bootstrap WordPress with the
system PHP and point mysqli at Local's socket (the hash changes when Local restarts the
site — re-glob it):

```bash
SOCK=$(ls ~/Library/Application\ Support/Local/run/*/mysql/mysqld.sock | head -1)
cd "/Users/haythamfourati/Local Sites/successcircles/app/public"
php -d mysqli.default_socket="$SOCK" -r 'define("WP_USE_THEMES",false); require "wp-load.php"; /* ... */'
```

Warnings are wrapped in `<b>` tags, so grep for the tag, not the bare word:

```bash
grep -cE '<b>(Warning|Notice|Deprecated|Fatal error)</b>' /tmp/sc.html
```

**Last verified baseline (2026-08-22):** zero PHP warnings on every route.
The quiz modal is rendered in `wp_footer` sitewide, so **every page carries 8 extra
`h2`s** — its six question steps plus the contact and thank-you steps. They sit inside a
closed `<dialog>` (`display: none`, out of the accessibility tree) and show one at a time
when open. Counts below are h1/h2/h3 *including* those 8:

`/` 1/**20**/**24** (was 1/21/26 before the homepage podcast section was removed) · `/about/` 1/17/2 · `/about-joseph-varghese/` 1/15/0 · `/testimonials/`
1/14/0 · `/weekly-wins/` 1/12/0 (and `?wins=3`) · `/rules-for-success/` 1/19/0 ·
`/faq/` 1/16/0 · `/contact-us/` 1/12/3 · `/?s=momentum` 1/**19**/0 · `/nope/` → 404 1/11/0.

`/?s=momentum` moved 18 → 19 when the wins page was retitled "Momentum Buzz" and became
an eighth search hit — 8 quiz + 8 result cards + 3 footer. Not a regression.

**Re-verified 2026-08-23** after the SEO work: zero PHP warnings on every route above,
every route emits exactly one canonical, one meta description and one JSON-LD graph with
no dangling `@id` references, and `/llms.txt` + `/llms-full.txt` both return 200
`text/plain`.
Weekly Wins cache: 528 wins across 15 pages, `sc_wins` autoload **off**.
Testimonials page: 11 films (all posters 200), 8 quotes.
86 loader dots (8+12+16+22+28).

---

## 12. Known issues / open items

- [ ] **Trailing space in folder name.** Offered to rename to `SuccessCirclesWP`; user has
      not confirmed. It works but is fragile with rsync/git/CI.
- [ ] **`assets/img/story-poster.png` is 2.5 MB** for 1914×1075. Lazy-loaded so LCP is
      unaffected, but WebP/JPEG conversion would cut ~95%. Left byte-identical to the
      original on purpose — don't re-encode without asking.
- [ ] **Remote images.** Founder portrait, signature and the 3 podcast thumbnails still
      load from `www.successcircles.com`; Inc./Trustpilot logos hotlink Wikimedia Commons
      `Special:FilePath`. Matches the design, but consider importing to the Media Library.
- [ ] **No `languages/` directory.** Strings are wrapped in `__()` with text domain
      `successcircles`, but no `.pot` has been generated.
- [x] **About is built** (`page-about.php`; WP page id 6, slug `about`). Copy transcribed
      from `successcircles.com/about/` into the `about` block of `inc/content.php`. It
      deliberately has NO section eyebrows and NO 01/02/03 markers — those belong to the
      homepage's ordered sequence and read as scaffolding anywhere else. Each section has
      its own composition; read the "About page" block in `main.css` before flattening any
      of it back into uniform two-column rows. The two supporting sentences under the core
      values are **written copy, not client copy** (the source lists only the two value
      titles) — get them approved.
- [x] **The blog / podcast is built and local.** `home.php` (Posts page, slug
      `rules-for-success`) + `single.php`. Seven real "Rules for Success" posts and their
      featured images were imported from `successcircles.com` into this install, so the
      homepage section, the listing and the single posts all resolve locally. They are
      demo content — replace or trim as the client wants.
- [x] **Testimonials page runs on the live Weekly Wins feed** (`page-testimonials.php`,
      slug `weekly-wins`, WP page id 11, renamed from `testimonials` on 2026-08-22) —
      see §7e. Composition: opener split then a multi-column quote wall.
- [x] **Testimonials page is built** (`page-testimonials.php`, slug `testimonials`, WP
      page id 68) — see §7f. 11 member films + 8 written testimonials.
- [ ] **Testimonials page framing copy is written here**, not client copy: the lede, the
      two section headings ("Eleven members, in their own voice.", "What members write to
      us.") and the "Nothing loads from Vimeo until you press play." note. The quotes and
      names themselves are verbatim from the live site. If films are added or removed,
      "Eleven members" has to change with them.
- [ ] **11 orphaned `sc_testimonial` rows** are still in the database from before the
      CPT was removed. Harmless and invisible (the type is no longer registered), left
      in place rather than deleting content unasked. Delete them when the client is
      happy the wins feed has replaced them for good.
- [x] **The About copy is now the live copy**, re-scraped from `successcircles.com/about/`
      on 2026-08-22 and used verbatim for the mission, vision, core values and story.
      Two things are still ours, not the client's: the **supporting sentence under each
      core value** (the live page gives only the two titles) and the **three arc figures**
      (8 / 1% / Thousands). The designed display headlines are also ours by intent — the
      live equivalents are plain section labels ("Our Mission") the design expresses
      differently.
- [ ] **`assets/img/about/jv-portrait.png` is 1.3 MB** for 1200×2000. It is the opener
      image on the Joseph Varghese page, so unlike `story-poster.png` this one **does**
      affect LCP. Left byte-identical to the original — needs the client's OK before
      re-encoding, but it is the single biggest win available on that page.
- [ ] **New written copy needs approval:** the ledes in the `episodes` and
      `testimonials` blocks of `inc/content.php` were written here, not taken from
      the client site.
- [x] **FAQ page is built** (`page-faq.php`, slug `faq`, WP page id 51). Thirteen Q&As
      transcribed from `successcircles.com/faq/` into the `faq_page` block of
      `inc/content.php`, grouped into three labelled sets and rendered as native
      `<details>` accordions — searchable, keyboard-operable, works with no JS. A sticky
      category rail and a help card hold the left column; FAQPage JSON-LD is built from
      the same array that renders the visible Q&A.
- [x] **Contact page is built** (`page-contact-us.php`, slug `contact-us`, WP page id 53).
      Details transcribed from `successcircles.com/contact-us/`: 290 5th Ave 5th Floor,
      New York NY 10001 · +1 (747) 2CIRCLE / 224-7253 (calls and WhatsApp Business) ·
      `jv.zone` for booking · `g.page/successcircles`. Copy lives in the `contact` block
      of `inc/content.php`. The form is real and plugin-free — see §14.
- [ ] **Contact page copy needs approval:** the heading, lede, the three channel notes and
      the three "what happens next" steps were written here, not taken from the client
      site. In particular "answers within one business day" is a promise the client has
      to be willing to keep.
- [ ] **The six seeded test questions are demo copy**, written here, not by the client.
      They are seeded once (on theme activation, and were seeded into this install on
      2026-08-22) only when no `sc_question` exists. The client rewrites them in the
      admin — the quiz copy in the `quiz` block of `inc/content.php` (form heading,
      privacy note, thank-you screen, "within one business day") needs approval too.
- [ ] **"Twelve questions" vs six.** The homepage `test` block still reads *"Twelve
      questions on ownership, focus, and execution &mdash; then a straight read on where
      the leak is"*, but only six questions are seeded and there is no scoring. That
      sentence is design-prototype copy, so it is the client's call: write twelve
      questions, or change the sentence. Not a code fix.
- [ ] **One demo lead** ("Test Person / test@example.com") sits in Test Leads from the
      end-to-end check. Trash it before launch.
- [ ] **Still pointing at `successcircles.com`:** Member Login (a real external member
      portal — leave it), Momentum Buzz / weekly wins, Privacy, and Terms. The nav, the
      footer and the homepage's "Read the full FAQ" now resolve locally to `/faq/` and
      `/contact-us/`.

---

## 12b. The Entrepreneur Test (`inc/quiz.php`)

No plugin, no separate database. Questions are `sc_question` posts — add, reorder
(page-attributes **Order**) and delete them under **Entrepreneur Test** in the admin.
A question needs at least two answer options, one per line in the *Answer options*
box; one with fewer is dropped rather than stalling the modal.

`template-parts/quiz-modal.php` renders **every step server-side** into a native
`<dialog>` (backdrop, focus trap and Escape come free) hooked to `wp_footer`; the
modal only renders when at least one usable question is published. `initQuiz()` in
`theme.js` does nothing but toggle `hidden`, so there are no template strings in
JavaScript. One question per step, click an answer to advance, a Back button, then a
Full name / Email / Phone step, then the thank-you screen.

Submission is `admin-ajax.php` `action=sc_quiz`: nonce `sc_quiz`, honeypot `sc_site`
(fake success, as on the contact form), throttle of one per email+IP per minute,
server-side validation (name required, `is_email()`, ≥7 digits of phone). **Answers
are only trusted as far as the question list** — anything that is not one of that
question's own options is discarded, never stored. The lead is a `sc_lead` post
(name / transcript / email+phone meta, listed with email and phone columns) and a
copy is mailed to the same recipient as the contact form.

The buttons are wired by `successcircles_test_link_attrs()`, which prints the ordinary
`href` **plus** `data-sc-quiz` when questions exist — so with JavaScript off every
"Take the Entrepreneur Test" button still goes to `sc_test_url`. Call sites: header
(×2), hero, section 06, programs, the closing CTA band, FAQ page, 404. Never hand-write
the `href` on those buttons again; use the helper.

The closing CTA's primary button was labelled "Take the Entrepreneur Test" but linked to
`successcircles_apply_url()` — the prototype does the same at line 489, and the theme had
transcribed it faithfully. It now opens the test. The application funnel is still reached
from the Momentum Buddy program card.

The footer's "Entrepreneur Test" nav link is **deliberately not** wired to the modal: it
scrolls to section 06, whose own button opens it. Wiring it would mean threading the
attribute through `successcircles_nav_list()`, which also has to keep working for
admin-assigned menus.

**The visitor is never emailed — by design.** The only mail is the owner notification;
there is no auto-reply and no automated result, so the modal copy promises a human
follow-up ("someone will come back to you"), never a delivered diagnostic. If that copy
is ever changed back to promising a "read" by email, the code has to change with it.

Deliberately skipped: a visitor auto-reply (considered and declined), scoring/result
branching (answers are stored, so a score can be computed later), CSV export, a captcha.

## 13. The contact form — CF7 when present, built-in otherwise

`successcircles_contact_form()` (in `inc/cf7.php`) is the single render call on
`page-contact-us.php`. Fields, in both forms: **name, email, phone (optional), message**.

### Contact Form 7 (`inc/cf7.php`)

If CF7 is active, the theme **provisions its own form on the first contact-page render** —
`WPCF7_ContactForm::get_template()` → `set_properties()` → `save()`, id stored in the
non-autoloaded `sc_cf7_form` option. Nothing to paste into the page; moving the theme to a
site that has CF7 sets itself up on the first visit. If the form is later deleted in the
admin the option no longer resolves and a fresh one is created.

- **The CF7 form template is the theme's own markup** (`.sc-field`, `.sc-field__input`,
  `.sc-btn`) with `[text*]` / `[email*]` / `[tel]` / `[textarea*]` in place of the inputs,
  so CF7's output needs no parallel stylesheet — only its wrappers and messages are
  dressed, at the end of the form block in `main.css`.
- `wpcf7_form_class_attr` adds `sc-form` to the `<form>`; `wpcf7_autop_or_not` is turned
  off **for this form only** (via `WPCF7_ContactForm::get_current()`), because autop
  litters block markup with stray paragraphs.
- Mail: recipient is `successcircles_contact_email()` **at creation time**. Changing the
  Customizer recipient afterwards does not rewrite the saved form — the client edits it in
  CF7's own admin, which is where they would look.
- No "sent from" line in the mail body: CF7 posts through its REST endpoint, so `[_url]`
  is the endpoint, not the page.
- **Verified end to end on 2026-08-23** with CF7 6.1.7: auto-provision on first render,
  idempotent on the second, a real REST submission returned `mail_sent` with the phone in
  the body and `Reply-To` set. CF7 is installed and active on this local site.

### The built-in fallback (`inc/contact.php` + `template-parts/contact-form.php`)

Used whenever CF7 is not active. Unchanged in behaviour:


No plugin, no AJAX, no third-party service. The form posts to `admin-post.php` with
`action=sc_contact`; `successcircles_handle_contact()` validates and redirects back to
`/contact-us/#sc-contact-form` with a `sc-contact` status the template renders as a
notice. Statuses: `sent` · `invalid` · `expired` · `throttled` · `failed`.

- **Nonce** `sc_contact`, **honeypot** `sc_site` (a bot that fills it gets a fake success
  page so it learns nothing), **throttle** of one send per email+IP per minute.
- Validation is server-side and non-negotiable: name required, `is_email()`, message ≥10
  characters. `required` / `type="email"` on the inputs is a convenience on top, not the
  check — the form carries `novalidate` so the server path is always exercised.
- On a failed submission the values ride back in a 5-minute transient keyed by a token in
  the URL, so a long message survives the round trip.
- Delivery goes to Customizer → SuccessCircles → Contact & social → **Contact form
  recipient**, falling back to the site admin email. `Reply-To` is the sender.
- Real spam volume needs a captcha on top of the honeypot. Nothing here logs submissions
  to the database — if the client wants an archive, that is a new decision.

---

## 14. Key external URLs (from the design)

| Purpose | URL |
| --- | --- |
| Application / test funnel | `https://peersc.com/applyscsite` |
| Momentum Labs | `https://momentumhuddle.com/` |
| Momentum Buddy | `https://www.momentumbuddy.com` |
| Affiliates | `https://ilovemomentum.com/` |
| Member Login | `https://www.successcircles.com/member-resources/` |
| Testimonials / Weekly Wins / Blog / FAQ | `successcircles.com/{testimonials,weekly-wins,blog,faq}/` |
| Phone | +1 (747) 2CIRCLE — +1 (747) 224-7253 |
