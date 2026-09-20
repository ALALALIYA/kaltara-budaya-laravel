---
name: Kaltara Budaya
description: Gamified cultural learning platform for North Kalimantan arts — rooted, alive, rewarding.
colors:
  canopy-deep: "#1a4731"
  canopy-dark: "#0f2d1f"
  canopy-void: "#1c1028"
  amber-primary: "#d97706"
  amber-bright: "#f59e0b"
  amber-light: "#fbbf24"
  ember-hot: "#f97316"
  ember-deep: "#c2410c"
  body-warm: "#fffbeb"
  surface: "#ffffff"
  surface-dark: "#111827"
  surface-card-dark: "#1f2937"
  ink: "#111827"
  ink-muted: "#6b7280"
  dayak-green: "#166534"
  dayak-green-surface: "#dcfce7"
  banjar-amber: "#92400e"
  banjar-amber-surface: "#fef3c7"
  kutai-red: "#991b1b"
  kutai-red-surface: "#fee2e2"
  tidung-blue: "#1e40af"
  tidung-blue-surface: "#dbeafe"
typography:
  display:
    fontFamily: "Figtree, sans-serif"
    fontSize: "clamp(2.5rem, 5vw, 3.75rem)"
    fontWeight: 900
    lineHeight: 1.1
    letterSpacing: "-0.02em"
    fontFeature: "'cv02', 'cv03', 'cv04', 'cv11'"
  headline:
    fontFamily: "Figtree, sans-serif"
    fontSize: "1.875rem"
    fontWeight: 800
    lineHeight: 1.2
  title:
    fontFamily: "Figtree, sans-serif"
    fontSize: "1.25rem"
    fontWeight: 700
    lineHeight: 1.3
  body:
    fontFamily: "Figtree, sans-serif"
    fontSize: "1rem"
    fontWeight: 400
    lineHeight: 1.625
  label:
    fontFamily: "Figtree, sans-serif"
    fontSize: "0.75rem"
    fontWeight: 600
    lineHeight: 1.4
rounded:
  sm: "8px"
  md: "12px"
  lg: "16px"
  full: "9999px"
spacing:
  sm: "8px"
  md: "16px"
  lg: "24px"
  xl: "40px"
components:
  button-primary:
    backgroundColor: "{colors.amber-light}"
    textColor: "{colors.canopy-deep}"
    rounded: "{rounded.lg}"
    padding: "16px 32px"
  button-primary-hover:
    backgroundColor: "{colors.amber-bright}"
    textColor: "{colors.canopy-dark}"
  button-nav:
    backgroundColor: "{colors.amber-light}"
    textColor: "{colors.canopy-deep}"
    rounded: "{rounded.md}"
    padding: "8px 20px"
  pill-dayak:
    backgroundColor: "{colors.dayak-green-surface}"
    textColor: "{colors.dayak-green}"
    rounded: "{rounded.full}"
    padding: "4px 12px"
  pill-banjar:
    backgroundColor: "{colors.banjar-amber-surface}"
    textColor: "{colors.banjar-amber}"
    rounded: "{rounded.full}"
    padding: "4px 12px"
  pill-kutai:
    backgroundColor: "{colors.kutai-red-surface}"
    textColor: "{colors.kutai-red}"
    rounded: "{rounded.full}"
    padding: "4px 12px"
  pill-tidung:
    backgroundColor: "{colors.tidung-blue-surface}"
    textColor: "{colors.tidung-blue}"
    rounded: "{rounded.full}"
    padding: "4px 12px"
  stat-card:
    backgroundColor: "{colors.surface}"
    textColor: "{colors.ink}"
    rounded: "{rounded.md}"
    padding: "20px"
---

# Design System: Kaltara Budaya

## 1. Overview

**Creative North Star: "The Living Heirloom"**

Kaltara Budaya is not a skin on top of an edtech template — it is a cultural artifact built to be used. Like a woven cloth that belongs to a family, this design system carries identity in every thread: in the forest green that names North Kalimantan's canopy, in the amber gold that runs through Dayak adornment, in the four colors that give each ethnic group its own unmistakable voice. Nothing decorates for decoration's sake. Every pattern, every glow, every texture is load-bearing cultural texture.

The system must feel earned, not given. Students arrive at this platform as learners in a structured school curriculum; they leave (ideally) as people who know something real about where they are from. The interface should feel like it takes the culture seriously: dense where learning demands density, energetic where games and rewards call for it, still and focused on an exam page. The design serves the learning contract, not the other way around.

This system explicitly rejects three aesthetics: the stiff gray layouts of government education portals — the kind that look like they were designed by a procurement office; the generic western edtech SaaS aesthetic (Inter on white, purple-to-blue gradients, identical SVG-icon cards); and the primary-color cartoon register of apps built for younger children. Kalimantan Utara's cultural heritage is serious subject matter. The design must match that.

**Key Characteristics:**
- Dark canopy green as the primary identity surface — nav, hero, footer, and dashboard headers
- Amber gold as the single primary action accent — CTAs, XP bars, earned states
- Four ethnic culture colors (Dayak/Banjar/Kutai/Tidung) as a semantic system, never decorative
- Figtree across all type roles — single family, weight range 400–900
- Elevation through tonal green layering on brand surfaces; clean flat-then-lift on content surfaces
- Motion that respects the task: state feedback and entrances, never orchestrated page-load sequences

## 2. Colors: The Kaltaran Palette

A three-tier system: identity colors (canopy green family), accent/reward colors (amber gold family), and ethnic heritage colors (the four culture system). Neutral surfaces handle content legibility.

### Primary
- **Kalimantan Canopy** (`#1a4731`): The dominant identity color. Used on all primary brand surfaces — navigation, hero sections, footer, dashboard welcome headers. Not a background color for content; a signature for brand.
- **Canopy Dark** (`#0f2d1f`): The deeper layer used in multi-stop gradients alongside Kalimantan Canopy. Creates tonal depth without flattening.
- **Canopy Void** (`#1c1028`): A deep purple-charcoal used as the dark terminus in hero gradients, adding a warm depth dimension that keeps surfaces from feeling like flat green rectangles.

### Secondary
- **Amber Gold** (`#d97706`): The primary action accent. Used on scrollbars, XP bar fills, hover glow effects, and badge states. The color of earned reward.
- **Amber Bright** (`#f59e0b`): Mid-amber for XP shimmer and gradient pairing with Amber Gold.
- **Amber Light** (`#fbbf24`): The CTA button face color. Light enough to contrast against `#1a4731` text at WCAG AA; warm enough to read as gold.

### Tertiary
- **Ember Hot** (`#f97316`): Used in fire-themed reward states and secondary CTAs. The "fire streak" register — energy, urgency.
- **Ember Deep** (`#c2410c`): The hover/active state for Ember Hot; anchors fire-themed elements without bleeding into the amber system.

### Neutral
- **Body Warm** (`#fffbeb`, Tailwind `amber-50`): Light mode body background. Chosen for its very slight amber warmth that resonates with the gold palette without becoming cream. Use on light-mode content surfaces only; never on brand-surface sections.
- **Surface White** (`#ffffff`): Dashboard stat cards, material content areas, form inputs.
- **Ink** (`#111827`): Body text on light surfaces.
- **Ink Muted** (`#6b7280`): Supporting text, timestamps, subtext — only on white/`body-warm` surfaces. Never on any tinted or green background.
- **Surface Dark** (`#111827`): Dark mode body background.
- **Surface Card Dark** (`#1f2937`): Dark mode card surfaces.

### The Four Cultures (Ethnic Heritage System)
Each culture holds its own dedicated color pair — surface tint + ink. These are semantic, not decorative. Use only for ethnic content categorization, never for generic UI state.
- **Dayak**: Forest Green (`#166534` ink / `#dcfce7` surface)
- **Banjar**: Deep Amber (`#92400e` ink / `#fef3c7` surface)
- **Kutai**: Deep Red (`#991b1b` ink / `#fee2e2` surface)
- **Tidung**: Deep Blue (`#1e40af` ink / `#dbeafe` surface)

### Named Rules
**The One Accent Rule.** Amber gold is the reward color. It appears on CTAs, XP bars, and earned states. It is never used for decorative backgrounds, borders, or text styling on content that hasn't been earned. Its scarcity is the signal.

**The Culture Parity Rule.** No ethnic culture color is ever used as a default, fallback, or generic state indicator. Dayak green is never "just a green button." Each pill, tag, or label that uses a culture color is explicitly about that culture's content.

**The Muted Text Rule.** `#6b7280` (Ink Muted) is forbidden on any surface darker than `#ffffff`. On canopy-green backgrounds, use `rgba(255,255,255,0.7)` or `#86efac` (Tailwind `green-300`) for supporting text.

## 3. Typography

**Display/Body Font:** Figtree (with `sans-serif` fallback)
**Label/UI Font:** Figtree (same family, tighter weight and tracking)

**Character:** A single humanist sans in nine weights. Figtree's subtle letterform warmth keeps the interface from feeling cold or clinical — important for a culturally-rooted product. The font feature settings (`cv02`, `cv03`, `cv04`, `cv11`) sharpen numeral and punctuation distinctiveness, which matters in an XP/score-heavy UI where numbers carry meaning.

### Hierarchy
- **Display** (900 weight, `clamp(2.5rem, 5vw, 3.75rem)`, line-height 1.1, tracking `−0.02em`): Hero headings on landing and dashboard welcome banners only. Maximum one per page section. Never on white content surfaces.
- **Headline** (800 weight, `1.875rem / 30px`, line-height 1.2): Section titles, dashboard panel headers, exam page titles.
- **Title** (700 weight, `1.25rem / 20px`, line-height 1.3): Card headings, material list items, nav section labels.
- **Body** (400 weight, `1rem / 16px`, line-height 1.625): All reading content — material text, question bodies, descriptions. Cap line length at 65–75ch on content pages; exams may run narrower for focused reading.
- **Label** (600 weight, `0.75rem / 12px`, line-height 1.4): UI labels, stats beneath XP numbers, pill text, button text at smaller scale, timestamps. Not uppercase by default; uppercase only for explicit system labels.

### Named Rules
**The Single Family Rule.** Figtree handles every type role. Never introduce a second family for display or cultural decoration. Weight range (400–900) provides all the contrast the hierarchy needs.

**The Weight Contrast Rule.** Adjacent type elements must differ by at least 200 weight units or 0.25rem in size. Two `font-semibold` elements at the same size are not a hierarchy — they are noise.

## 4. Elevation

This system uses **tonal layering on brand surfaces, clean flat-then-lift on content surfaces**. There are no hard drop shadows at rest on any surface. Shadows appear only as state responses (hover, lifted, focused).

Brand surfaces (canopy-green hero, nav, footer, dashboard headers) achieve depth through multi-stop gradients — `#1a4731 → #0f2d1f → #1c1028` — and through glass-card overlays on dark backgrounds when purposeful. This is not glassmorphism as decoration; it is tonal separation.

Content surfaces (white cards, stat panels, material readers) are flat at rest. On hover, cards lift with a single diffuse shadow to signal interactivity.

### Shadow Vocabulary
- **Card Lift** (`0 16px 40px rgba(0,0,0,0.12)`): Applied on card hover only. Never at rest.
- **Amber Glow** (`0 12px 32px rgba(217,119,6,0.45), 0 4px 16px rgba(0,0,0,0.2)`): CTA button hover state. The primary action feedback. No other element should glow amber.
- **Badge Pulse** (`0 0 0 8px rgba(251,191,36,0)` pulsing from `0 0 0 0 rgba(251,191,36,0.4)`): Earned badge state only. Rings out like a reward, not a notification.
- **Panel Shadow** (`0 1px 3px rgba(0,0,0,0.08), 0 1px 2px rgba(0,0,0,0.06)`): Dashboard stat cards, light elevation for structural separation.

### Named Rules
**The Flat-At-Rest Rule.** No surface casts a shadow at rest. Cards, modals, panels, and nav items are flat until state changes (hover, active, earned). Decoration shadows violate the system's legibility principle.

## 5. Components

### Buttons
- **Shape:** Generously curved (16px radius / `rounded-2xl`) for primary CTAs; 12px (`rounded-xl`) for nav-scale actions.
- **Primary CTA:** Amber Light (`#fbbf24`) background, Kalimantan Canopy (`#1a4731`) text. Bold weight (700+). Padding `16px 32px`. On hover: lifts `2px`, amber glow activates (`0 12px 32px rgba(217,119,6,0.45)`), background steps to Amber Bright (`#f59e0b`). Transition: `transform 0.2s ease, box-shadow 0.25s ease`.
- **Ghost / Text:** `text-green-100` on dark surfaces, `hover:bg-white/10` treatment. No border. Used for secondary nav actions.
- **Fire CTA (secondary brand):** Ember Hot (`#f97316`) gradient for streak/game-related calls. Never used as the primary page action.
- **Disabled:** 60% opacity, `pointer-events-none`, no hover state.

### Culture Chips / Pills
Semantic-only. Each pill carries culture color ink on culture color surface, full border-radius (9999px), 12px horizontal padding, 600 weight label text. Never use these as generic status tags.
- Dayak: `#166534` on `#dcfce7`
- Banjar: `#92400e` on `#fef3c7`
- Kutai: `#991b1b` on `#fee2e2`
- Tidung: `#1e40af` on `#dbeafe`

### Cards / Containers
- **Corner Style:** 16px radius (`rounded-2xl`) for primary content cards; 12px (`rounded-xl`) for stat panels and compact items.
- **Light Mode Background:** White (`#ffffff`) with `border border-gray-200` at 1px.
- **Dark Mode Background:** `#1f2937` with `border border-gray-700` at 1px.
- **Shadow Strategy:** Flat at rest (`shadow-sm` for structural separation only). `shadow-lg` (`0 16px 40px rgba(0,0,0,0.12)`) on hover via `.card-lift`.
- **Internal Padding:** 20–24px (`p-5`/`p-6`). Never less than 16px.
- **Prohibited:** Nested cards. A card inside a card is always wrong. Restructure with inner sections or list rows.

### Inputs / Fields
- **Style:** White background, `border border-gray-300`, 8px radius (`rounded-lg`). `@tailwindcss/forms` reset baseline.
- **Focus:** Ring offset approach — `focus:ring-2 focus:ring-amber-500 focus:border-amber-500`. The amber focus ring is the single interactive-state accent on input elements.
- **Error:** `border-red-500`, error message in `text-red-600 text-sm` below the field.
- **Disabled:** 60% opacity, gray background, no interaction.

### Navigation
- **Style:** Fixed top bar, full-width, forest gradient background (`#1a4731 → #0f2d1f → #1c1028`), `border-bottom: 1px solid rgba(255,255,255,0.08)`. Height: 64px.
- **Brand Mark:** Figtree 900 weight white `Kaltara` + amber `Budaya`. The 🌿 icon floats on `float-slow` animation — this is intentional; it's the only decoration in the nav.
- **CTA:** Amber Light (`#fbbf24`) background, Canopy (`#1a4731`) text. This is the highest-contrast element in the nav.
- **Mobile:** Collapses to a burger or CTA-only strip. The brand mark always stays visible.
- **Dark mode:** Nav remains forest-green regardless of system dark mode — it is not a tonal-neutral surface.

### XP Bar (Signature Component)
The XP progress bar is the primary reward indicator. It uses the shimmer animation (background-position cycling at 2.5s) on an amber gold gradient — the only UI element that animates indefinitely. This is intentional: it signals "progress is live." Style: 6–8px height, `rounded-full`, amber shimmer gradient (`#d97706 → #f59e0b → #fbbf24 → #f59e0b → #d97706`), `background-size: 200%`, transition on width change `duration-1000`.

### Dashboard Stat Cards
Text-centric counters: large number (800 weight, `text-2xl`), emoji above, label below in muted text. White/dark-800 card, rounded-xl, shadow-sm. Emoji is intentional — it is the icon system, not SVG icons. Maintains the youthful energy register without infantilizing.

## 6. Do's and Don'ts

### Do:
- **Do** use `#1a4731` as the primary brand surface for navigation, heroes, and panel headers. This color IS the brand.
- **Do** cap body line length at 65–75ch on material and exam content pages. Students are reading to learn; readability is performance.
- **Do** use the four culture colors (Dayak/Banjar/Kutai/Tidung) only for content tagged to that culture. They are semantic identifiers, not UI decoration.
- **Do** use Figtree 900 weight for display headings, 800 for headlines. The weight range is the hierarchy; size alone is not enough.
- **Do** apply amber glow (`rgba(217,119,6,0.45)`) only to primary CTA hover states. One glow color, one role.
- **Do** add `@media (prefers-reduced-motion: reduce)` alternatives for every animation — particularly the XP shimmer, scroll reveals, and badge pulse. Learning contexts include students with vestibular sensitivities.
- **Do** use tonal green layering (`bg-green-800`, `bg-green-900`) to create depth on dark surfaces. This is the elevation system on brand surfaces.
- **Do** ensure body text on dark green backgrounds is white or `green-100` / `green-200` — never `green-500` or lower-contrast greens.

### Don't:
- **Don't** build stiff gray layouts, bureaucratic heading hierarchies, or table-heavy screens that look like government procurement portals. This is the primary anti-reference.
- **Don't** use `background-clip: text` gradient text anywhere. This is banned globally. Use solid ink colors — weight and size carry emphasis.
- **Don't** use `border-left` greater than 1px as a colored stripe accent on cards, alerts, or list items. Rewrite with background tints or full borders.
- **Don't** use `bounceIn` or elastic easing on any animation. Ease out with `ease-out` or exponential curves. The current `bounceIn` keyframe in `app.css` should be removed.
- **Don't** use Ink Muted (`#6b7280`) on any surface darker than white. On green backgrounds it fails contrast. Use `text-green-300` or `rgba(255,255,255,0.7)` instead.
- **Don't** add a second typeface — not for display, not for cultural flavor, not for code. Figtree's 900-weight is more expressive than most display fonts.
- **Don't** use the amber/gold color system for decorative backgrounds, section borders, or any non-reward element. Gold means earned. Using it otherwise devalues the reward loop.
- **Don't** use identical card grids with the same icon + heading + text pattern across more than three consecutive cards. Break the grid with varied content types or layout shifts.
- **Don't** use modal dialogs as the first solution for confirmations, form expansions, or content previews. Inline, drawer, or progressive patterns are preferred.
- **Don't** introduce glassmorphism (`backdrop-blur` + semi-transparent bg) on content surfaces or light backgrounds. Glass is allowed only on dark canopy-green brand surfaces where it creates purposeful tonal separation.
