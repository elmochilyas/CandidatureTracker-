# CandidatureTracker — Design System

## Design Philosophy

**Creative Minimalism × Professional SaaS UI**

The interface should feel:

- Clean and structured like modern SaaS products
- Creative through gradients, glass effects, and bold spacing
- Professional enough for recruiters and productivity workflows
- Fast and lightweight visually
- Focused on readability and organization

### Inspiration

- Linear
- Notion
- Raycast
- Vercel
- Attio
- Arc Browser
- Supabase
- Stripe Dashboard

---

# Global UI Style

## Core Style Direction

| Element | Style |
|---|---|
| Layout | Spacious, grid-based |
| Corners | Large radius (`16px–24px`) |
| Shadows | Soft layered shadows |
| Borders | Subtle low-contrast borders |
| Typography | Clean sans-serif |
| Colors | Neutral base + vibrant accents |
| Effects | Glassmorphism + gradients |
| Animations | Smooth and subtle |
| Components | Floating cards style |

---

# Recommended Design System

# ✦ “NeoGlass Productivity”

A modern hybrid between:

- Glassmorphism
- Minimal SaaS dashboards
- Soft gradients
- Structured enterprise UI

The UI should look:

- elegant
- futuristic
- productivity-focused
- calm
- premium

---

# Primary Color Palette

## Option A — Midnight Indigo (Recommended)

### Main Palette

| Role | Color | Hex |
|---|---|---|
| Primary | Deep Indigo | `#5B5BD6` |
| Primary Hover | Electric Indigo | `#7272FF` |
| Accent | Cyan Blue | `#42C6FF` |
| Background | Rich Dark | `#0F1117` |
| Surface | Soft Dark | `#161A23` |
| Elevated Surface | Glass Surface | `#1D2330` |
| Border | Subtle Border | `#2A3142` |
| Text Primary | Soft White | `#F5F7FA` |
| Text Secondary | Cool Gray | `#A8B0C0` |
| Success | Emerald | `#22C55E` |
| Warning | Amber | `#F59E0B` |
| Danger | Rose Red | `#EF4444` |

---

## Background Gradient

```css
background:
linear-gradient(
135deg,
#0F1117 0%,
#141824 40%,
#191F2E 100%
);
```

---

# Alternative Color Palettes

---

## Option B — Arctic White SaaS

Clean premium enterprise style.

| Role | Hex |
|---|---|
| Primary | `#4F46E5` |
| Accent | `#06B6D4` |
| Background | `#F5F7FB` |
| Surface | `#FFFFFF` |
| Border | `#E5E7EB` |
| Text | `#111827` |

### Best For

- ultra-clean UI
- recruiter-focused aesthetic
- productivity dashboards

---

## Option C — Emerald Graphite

Creative but mature.

| Role | Hex |
|---|---|
| Primary | `#10B981` |
| Accent | `#34D399` |
| Background | `#0B1220` |
| Surface | `#111827` |
| Border | `#1F2937` |
| Text | `#F9FAFB` |

### Best For

- modern startup vibe
- highly visual dashboards
- futuristic feeling

---

# Typography

## Recommended Fonts

### Primary Font

```txt
Inter
```

### Alternatives

- Satoshi
- General Sans
- Plus Jakarta Sans
- Geist
- Manrope

---

## Typography Scale

| Usage | Size | Weight |
|---|---|---|
| Hero Title | 40px | 700 |
| Page Title | 30px | 700 |
| Section Title | 22px | 600 |
| Card Title | 18px | 600 |
| Body | 15px | 400 |
| Small Text | 13px | 400 |
| Labels | 12px | 500 |

---

# Spacing System

## 8px Grid System

| Token | Value |
|---|---|
| xs | 4px |
| sm | 8px |
| md | 16px |
| lg | 24px |
| xl | 32px |
| 2xl | 48px |
| 3xl | 64px |

---

# Border Radius

| Component | Radius |
|---|---|
| Buttons | 14px |
| Inputs | 16px |
| Cards | 24px |
| Modals | 28px |
| Badges | 999px |

---

# Shadows

## Soft Premium Shadows

```css
box-shadow:
0 10px 30px rgba(0,0,0,0.15);
```

## Elevated Glass Shadow

```css
box-shadow:
0 8px 32px rgba(31, 38, 135, 0.18);
```

---

# Glassmorphism Style

## Glass Card

```css
background: rgba(255,255,255,0.04);
backdrop-filter: blur(14px);
border: 1px solid rgba(255,255,255,0.08);
```

Use this on:

- dashboard cards
- filters panel
- sidebars
- statistics widgets

---

# Component Design

# Sidebar

## Style

- Floating sidebar
- Rounded corners
- Slight transparency
- Active item glow

## Navigation Icons

Use:

- Lucide Icons
- Heroicons

---

# Buttons

## Primary Button

```css
background: linear-gradient(
135deg,
#5B5BD6,
#7272FF
);
```

### Hover

- brighter glow
- lift animation

---

## Secondary Button

```css
background: rgba(255,255,255,0.05);
border: 1px solid rgba(255,255,255,0.08);
```

---

# Inputs

## Style

- Large padding
- Floating labels
- Soft borders
- Smooth focus ring

### Focus State

```css
border-color: #7272FF;
box-shadow: 0 0 0 4px rgba(114,114,255,0.15);
```

---

# Dashboard Layout

# Main Dashboard Structure

```txt
------------------------------------------------
 Sidebar     | Topbar
             |
             | Statistics Cards
             |
             | Applications Table
             |
             | Recent Interviews
             |
             | Activity Timeline
------------------------------------------------
```

---

# Dashboard Widgets

## Statistics Cards

Show:

- Active Applications
- Interviews Planned
- Offers Received
- Rejections
- Archived Applications

### Style

- Glass cards
- Gradient icons
- Large numbers
- Tiny trend indicators

---

# Application Status Colors

| Status | Color |
|---|---|
| Applied | `#3B82F6` |
| Interview | `#A855F7` |
| Technical Test | `#F59E0B` |
| Accepted | `#22C55E` |
| Rejected | `#EF4444` |
| Archived | `#6B7280` |

---

# Priority Colors

| Priority | Color |
|---|---|
| High | `#EF4444` |
| Medium | `#F59E0B` |
| Low | `#22C55E` |

---

# Table Design

## Applications Table

### Style

- Modern data-table
- Rounded rows
- Hover elevation
- Sticky header
- Alternating transparency

### Features

- Search
- Filters
- Sort
- Quick actions
- Status badges

---

# Animations

## Motion Style

Subtle and premium.

### Use

- Fade-in
- Slide-up
- Hover lift
- Smooth page transitions

### Duration

```css
transition: all 0.25s ease;
```

---

# Charts & Analytics

## Recommended Charts

- Funnel chart
- Applications timeline
- Weekly interview activity
- Status distribution

### Chart Style

- thin strokes
- soft gradients
- floating tooltips

---

# Empty States

## Style

Minimal but creative.

### Include

- soft illustrations
- motivational text
- subtle gradients

Example:

```txt
“No applications yet.
Start tracking your first opportunity.”
```

---

# Dark Mode Recommendation

## Strongly Recommended

This project fits perfectly with a:

- dark glassmorphism dashboard
- indigo/cyan gradients
- soft lighting effects

Dark mode will make the app feel:

- more premium
- more modern
- more “startup SaaS”

---

# Best Tech Stack for This UI

| Purpose | Recommendation |
|---|---|
| CSS Framework | TailwindCSS |
| Components | shadcn/ui |
| Icons | Lucide |
| Animations | Framer Motion |
| Charts | Recharts |
| Tables | TanStack Table |

---

# UI Keywords for AI UI Generators

Use these keywords:

```txt
modern saas dashboard,
glassmorphism,
premium productivity app,
minimal enterprise ui,
floating cards,
soft gradients,
dark indigo dashboard,
clean data table,
modern admin panel,
futuristic workspace,
linear app aesthetic,
notion inspired,
raycast inspired,
stripe dashboard style
```

---

# Final Recommendation

## Best Overall Direction

### Style

```txt
Linear + Notion + Stripe
with glassmorphism and soft gradients
```

### Palette

```txt
Midnight Indigo + Cyan
```

### Font

```txt
Inter
```

### UI Feeling

```txt
Premium
Clean
Creative
Professional
Modern
Focused
```