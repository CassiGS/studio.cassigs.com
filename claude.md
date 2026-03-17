# Claude.md — Studio Blog (Astro)

## Project overview

This is a personal studio blog and portfolio built with Astro. The visual direction is editorial and precise — influenced by scientific illustration conventions (annotation lines, specimen labels, field notebook aesthetics) with a navy + warm off-white palette.

---

## Tech stack

- **Framework**: Astro
- **Styling**: CSS Modules only (`.module.css` files)
- **Fonts**: Google Fonts via `@import` — Cormorant Garamond + DM Mono
- **Markdown**: Astro content collections for blog posts
- **No UI framework** unless explicitly added (no React, Vue, Svelte by default)

---

## Styling rules — read carefully

### CSS Modules only

**All styles must be written as CSS Modules.** This is a hard constraint.

- Every component gets its own `.module.css` file colocated alongside it
- Import styles as: `import styles from './ComponentName.module.css'`
- Apply classes as: `class={styles.className}`
- For multiple classes: `class={[styles.foo, styles.bar].join(' ')}`

### Tailwind is explicitly forbidden

- **Do not use Tailwind CSS** — not as a utility, not as a config, not as a plugin
- Do not suggest installing `@astrojs/tailwind` or `tailwindcss`
- Do not use Tailwind class names (e.g. `flex`, `text-sm`, `mt-4`) anywhere in templates
- If asked to add Tailwind, refuse and implement the styling in CSS Modules instead

### Global styles

- Global resets and CSS custom properties live in `src/styles/global.css`
- Import global styles in the root layout only: `src/layouts/BaseLayout.astro`
- Do not scatter global `<style>` tags across components unless scoped to that component via Astro's built-in scoped styles (and even then, prefer `.module.css`)

### CSS custom properties

All design tokens are defined in `src/styles/global.css` under `:root`. Always use these variables — never hardcode color hex values or font names in component stylesheets.

```css
:root {
  --navy: #1c2b4a;
  --navy-mid: #2e4270;
  --blue-rule: #4a6fa5;
  --blue-tint: #eef2f8;
  --off-white: #f4f1ea;
  --warm-white: #faf8f3;
  --ink: #1c2b4a;
  --ink-mid: #3d4f6e;
  --ink-muted: #7a8aaa;
  --ink-faint: #b8c2d4;
  --rule: rgba(74, 111, 165, 0.13);
  --rule-strong: rgba(74, 111, 165, 0.28);
  --font-serif: "Cormorant Garamond", Georgia, serif;
  --font-mono: "DM Mono", "Courier New", monospace;
}
```

---

## Project structure

```
src/
├── components/        # Reusable Astro components
│   ├── Header.astro
│   ├── Header.module.css
│   ├── PostCard.astro
│   ├── PostCard.module.css
│   └── ...
├── content/
│   └── blog/          # Markdown/MDX post files
├── layouts/
│   ├── BaseLayout.astro
│   ├── BaseLayout.module.css
│   ├── PostLayout.astro
│   └── PostLayout.module.css
├── pages/
│   ├── index.astro
│   ├── work.astro
│   ├── sketchbook.astro
│   └── about.astro
└── styles/
    └── global.css     # Tokens, resets, global typography only
```

---

## Component conventions

### File naming

- Components: `PascalCase.astro` + `PascalCase.module.css`
- Pages: `kebab-case.astro`
- Layouts: `PascalCase.astro` + `PascalCase.module.css`

### Astro component structure

Follow this order within `.astro` files:

```astro
---
// 1. Imports (components, styles, data)
import styles from './Component.module.css'
// 2. Props and logic
const { title, date } = Astro.props
---

<!-- 3. Template -->
<div class={styles.wrapper}>
  <h1 class={styles.title}>{title}</h1>
</div>
```

### No inline styles

Do not use `style="..."` attributes on elements. All styles belong in `.module.css` files. The only exception is dynamic values that cannot be expressed as classes (e.g. a CSS custom property set from a prop).

```astro
<!-- OK: dynamic custom property -->
<div style={`--accent: ${color}`} class={styles.card}>

<!-- Not OK: inline style shortcut -->
<div style="margin-top: 1rem;">
```

---

## Content collections

Blog posts live in `src/content/blog/` as `.md` or `.mdx` files.

### Frontmatter schema

```yaml
---
title: string # Post title
date: YYYY-MM-DD # Publication date
description: string # Short excerpt for cards and meta
tags: string[] # e.g. [anatomy, data-viz, process]
type: string # One of: process-note | sketchbook | thinking | data-viz
draft: boolean # true = excluded from production build
---
```

### Content collection config (`src/content/config.ts`)

```ts
import { defineCollection, z } from "astro:content";

const blog = defineCollection({
  schema: z.object({
    title: z.string(),
    date: z.coerce.date(),
    description: z.string(),
    tags: z.array(z.string()),
    type: z.enum(["process-note", "sketchbook", "thinking", "data-viz"]),
    draft: z.boolean().default(false),
  }),
});

export const collections = { blog };
```

---

## Typography rules

- **Headings**: `font-family: var(--font-serif)`, weight 300 or 400, with italic for emphasis
- **Body copy**: `font-family: var(--font-serif)`, weight 400, `font-size: 16px`, `line-height: 1.72`
- **Labels, nav, tags, meta**: `font-family: var(--font-mono)`, weight 300 or 400, small sizes (9–11px), `letter-spacing: 0.08em`
- Never use weights above 600
- Use `font-style: italic` within serif text for emphasis — do not use `<b>` or `font-weight: 700` for inline emphasis in body copy

---

## Visual design conventions

These are not optional — they define the site's identity:

- **Dot grid background**: applied via `::before` pseudo-element on the page wrapper using `radial-gradient`. See `global.css`.
- **Specimen markers**: section dividers use a small rotated diamond (`transform: rotate(45deg)`) + short rule line + mono label. Never use plain `<hr>` tags.
- **Annotation lines**: pull quotes and observations use a vertical leader line (dot → stem → tick), not blockquotes.
- **Corner registration marks**: illustration panels use `::before` / `::after` pseudo-elements for corner bracket marks.
- **Borders**: always `0.5px solid var(--rule-strong)`. Never use `1px` borders except for the active nav underline.
- **Border radius**: none by default. This site does not use rounded corners.

---

## Do not

- Do not install or configure Tailwind under any circumstances
- Do not use a CSS-in-JS library
- Do not use a component library (Shadcn, Radix, DaisyUI, etc.)
- Do not add a JavaScript framework (React, Vue, Svelte) unless explicitly requested for a specific interactive component
- Do not use `<style>` blocks inside `.astro` files as a substitute for `.module.css` files
- Do not hardcode font names, colors, or spacing values — always use CSS custom properties
- Do not use `px` values above 2px for borders
- Do not use `border-radius` unless explicitly asked

---

## When adding a new component

1. Create `ComponentName.astro` in `src/components/`
2. Create `ComponentName.module.css` alongside it
3. Define all styles in the `.module.css` file using CSS custom properties
4. Import and apply the module in the `.astro` file
5. Do not copy styles from another component's module — extract shared patterns to `global.css` as custom properties or to a shared utility class if truly necessary
