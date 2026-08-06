# Session handoff (Calendar Google Adapter)

Use this file so new chats pick up **recent package work**, **branch focus**, and **next steps**. Add newest sessions **at the top** (below `<!-- SESSION_LOG_START -->`). Do not store secrets.

**Repo:** https://github.com/InEngine/Calendar-Google-Adapter — Composer **`inengine/calendar-google-adapter`**. Path checkout: `InEngine/Modules/Calendar-Google-Adapter`. Depends on **`inengine/calendar`**.

**Alias:** Often referred to as the **Calendar adapter** (module/repo). Same thing as this package.

**Role:** Google Calendar API implementation of Calendar provider contracts (auth, fetch/map events). Keep LTC widgets and domain types in the host / **`inengine/calendar`**.

---

## Idea sketch (two-package split — agreed 2026-08-05)

Issue **#143** (LTC home widgets) is two problems: an **app-facing calendar domain**, and **how you fetch**. Split mirrors TableUI-style packaging: host talks to one API; providers plug in.

| Package | Owns |
|--------|------|
| **`inengine/calendar`** | Contracts (`CalendarProvider`, maybe `ReadsEvents` / `ListsCalendars`), DTOs (`Event`, `TimeRange`, `CalendarRef`), config for selected calendars, cache/query facade. Optional presentation primitives later — leave My LTC widgets in the host until UI settles. |
| **`inengine/calendar-google-adapter`** (this package; **Calendar adapter**) | Implements the provider against Google Calendar API; auth (service account / domain-wide or OAuth as chosen); maps Google payloads → DTOs; owns `google/apiclient` (or similar). Keep this package **thin**. |

**Core:** selection model (“these calendar IDs are school-wide upcoming / meals / schedule”), normalize timezones, merge/sort events from multiple sources, cache keys, rate-limit-friendly `eventsBetween($calendars, $from, $to)` + short TTL for v1, authorization hooks. Tests bind a **fake provider** without Google.

**This package (adapter):** auth, calendar list sync, incremental sync / etags later, Google-specific errors, webhook/push later if needed. Do **not** own LTC Blade or core DTOs.

**LTC app:** home widgets, layout per role, which feed maps to which widget.

**Caveats:** don’t invent a huge sync engine first; **school shared calendars ≠ user OAuth** (decide auth early — drives this package); class schedule “later personalized” may be SIS/enrollment via a **non-Google** provider in core — do not bend this adapter to cover that. Suggested from **`inengine/calendar`** via Composer **`suggest`**; hosts that need Google require this package explicitly.

**#143 practical plan:** ship both; Google as only provider initially; LTC widgets as first consumer; this adapter stays dumb and replaceable.

---

## How to update

1. Paste a new block **below** `<!-- SESSION_LOG_START -->`.
2. Mention branch, issue/PR links (LTC **#143**), Google auth approach, and host bump notes.

<!-- SESSION_LOG_START -->

### 2026-08-05 — Renamed Calender → Calendar (repo + directory)

- **GitHub:** **`InEngine/Calender-Google-Adapter`** → **`InEngine/Calendar-Google-Adapter`** (old URL redirects).
- **Disk:** `Modules/Calender-Google-Adapter` → `Modules/Calendar-Google-Adapter`.
- **Also:** homepage / issue templates / Cursor rules + LTC handoff / PHPStorm roots updated; LTC vendor symlink refreshed.
- **Next:** GitHub workflow sync from TableUI (if not already committed) + Calendar contracts.

### 2026-08-05 — Cursor rules + githooks; Calendar adapter alias

- **Status:** Copied TableUI-style **`.githooks`** (Cursor co-author strip) and workspace Cursor **`.cursor/rules`** (attribution, session handoff, PHP standards, issue assignee, `.DS_Store`).
- **Alias:** Informal name **Calendar adapter** documented in handoff + **`package.mdc`**.
- **Next:** wait for **`inengine/calendar`** contracts; then implement Google provider.

### 2026-08-05 — Idea sketch recorded

- **Status:** Scaffold still in place; architecture sketch pasted into this handoff (and sibling Calendar handoff) for later implementation.
- **Note:** Calendar core now **`suggest`s** this package in its `composer.json`.
- **Next:** wait for **`inengine/calendar`** contracts; then implement Google provider; decide service-account vs OAuth for school shared calendars.

### 2026-08-05 — Scaffold wired for LTC #143

- **Status:** **In progress** with LTC **`issue-143-calendar-widgets`**.
- **Package:** Spatie skeleton configured as **`inengine/calendar-google-adapter`** / **`InEngine\CalendarGoogleAdapter`** (PHP **`^8.5`**); requires **`inengine/calendar`: `@dev`**. Still skeleton — no Google client integration yet.
- **Host (LTC):** path/`@dev` via **`composer.local.json`**; PHPStorm roots + VCS mapping on the LTC app module.
- **Next:** implement provider against Google after **`inengine/calendar`** contracts exist; decide service-account vs OAuth for school shared calendars.

