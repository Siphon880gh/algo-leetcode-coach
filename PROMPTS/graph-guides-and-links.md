# Graph: Algo Guides + Step-by-step, keep counts within 20, always pair

One graph tick = **one author child** (either algo-guides or step-by-step) **then** the **pairing half**. This graph **owns** guide ↔ session linking. Do not run a standalone links loop.

Read this file and the child trackers every tick. The pairing ledger is [`loop-guide-step-links.track.json`](loop-guide-step-links.track.json) (not a separate agent task).

## Invoke

```
/loop Follow PROMPTS/graph-guides-and-links.md. Each tick: count algo guides vs step-by-step. If one side is more than 20 ahead, author one companion on the lagging side for a slug that already has the leading side. Otherwise one algo-guides problem. Then one pairable guide↔step link. Update the child trackers you touched before you finish the tick.
```

## Why this graph

Author loops walk the same `context/` order, so one side can pull ahead. A union walk that skips `"no_pair"` would burn slugs that exist on only one side.

This graph:

- Authors **Algo Guides** while they are not more than 20 ahead of Step-by-step
- When Algo Guides are **more than 20** ahead, authors a **Step-by-step** for a slug that already has an Algo Guide (companion keys both ways)
- When Step-by-step is **more than 20** ahead, authors an **Algo Guide** for a slug that already has a session (companion keys both ways)
- When authoring either side, scans existing mini games (same slug, related keys, or same `leetcode`) and writes `related_game` so the new page can link to the game
- Then pairs one intersection slug (`related_session` / `related_guide`)

Mini games are a separate task ([`loop-mini-games.md`](loop-mini-games.md)); they link to an Algo Guide and, if it exists, a Step-by-step.

## Difficulty (author halves)

When an author half creates a numbered LeetCode Algo Guide or Step-by-step, `meta.php` must set `'leetcode'` and `'difficulty'` (`Easy` | `Med` | `Hard`) as in the child prompt. Look up from `context-leetcode-urls/data-difficulty.json` (do not `Read()` the file whole). Do not invent. Never put Easy / Med / Hard in `title`. Mini games use the same keys.

## Problem statement first (author halves)

Before an author half writes a numbered LeetCode guide or session, it must fetch the official statement with `.agents/skills/fetch-leetcode-problems` (`fetch.py N`, then `build.py N`) so `content/problems/{N}.html` exists, or `N` is recorded in `content/problems/premium.json`. The app renders that statement at the top of both page types; the new page must not restate it (premium problems keep a short own-words restatement instead). If the fetch fails for network reasons, end the tick without authoring and report it. Never log in to LeetCode.

## Counts (every tick)

Ignore `kind => 'cursor'` guides (for example `add-mini-game`). Missing `kind` counts as algo.

| Symbol | Meaning |
|--------|---------|
| `G` | Number of `content/guides/{slug}/` with `kind => 'algo'` |
| `S` | Number of `content/coaching/{slug}/` |
| Ahead | `G > S + 20` → guides lead; `S > G + 20` → sessions lead |

`20` is exclusive: a lead of 20 stays on the default (algo-guides) half. A lead of 21 switches to the lagging author.

## Nodes

```
count G vs S
        |
        +-- G > S + 20 --> loop-step-by-step.md  (slug must already have an algo guide)
        |
        +-- S > G + 20 --> loop-algo-guides.md   (slug must already have a session)
        |
        +-- else       --> loop-algo-guides.md   (context next)
        |
        v
pairing half --> related_session / related_guide
        |        (intersection only while authors still run)
        v
repeat
```

## Link contract (pairing half)

Same folder slug:

- `content/guides/{slug}/` with `kind => 'algo'`
- `content/coaching/{slug}/`

Ignore `kind => 'cursor'` guides. Both directions, or the pairing half is not done:

| Side | `meta.php` key | Chrome |
|------|----------------|--------|
| Algo Guide | `'related_session' => '{slug}'` | **Step-by-step** → `coaching/session.php?id={slug}` |
| Algo Guide | `'related_game' => '{gameSlug}'` | **Mini game** → `games/play.php?id={gameSlug}` |
| Step-by-step | `'related_guide' => '{slug}'` | **Algo Guide** → `guides/view.php?id={slug}` |
| Step-by-step | `'related_game' => '{gameSlug}'` | **Mini game** → `games/play.php?id={gameSlug}` |
| Mini game | `'related_guide'` / `'related_session'` | **Algo Guide** / **Step-by-step** on `games/play.php` |

Keep every other `meta.php` field as-is. Do not rewrite `body.md`, `body.php`, or `tree.php`. Chrome lives in the page-head on `guides/view.php`, `coaching/session.php`, and `games/play.php`. Render a companion link when the matching artifact is on disk (related key, same slug, or same `leetcode`). Do not add routes.

## Once (if missing)

Before the pairing half on a tick, if chrome or harness docs are still missing, do this **once** in that tick, then continue:

1. Page-head companion links on `guides/view.php`, `coaching/session.php`, and `games/play.php` as in **Link contract**.
2. Document optional `related_session` / `related_game` (guides), `related_guide` / `related_game` (coaching), and `related_guide` / `related_session` (games) in `.agents/skills/harness/SKILL.md` and `.agents/skills/harness/reference.md`. Document `'difficulty' => 'Easy'|'Med'|'Hard'` whenever `'leetcode'` is set.
3. In `loop-algo-guides.md` and `loop-step-by-step.md`: when creating an artifact, if the same slug already exists on the other side, set the companion key. If a matching mini game already exists, set `related_game`. Those loops must not backfill every existing pair.

Skip this block on later ticks if it is already in place.

## Each graph tick

1. If both author trackers are `exhausted` **and** there is no unlinked pair (see **Pairing half**), stop the graph. Do not arm another wake.
2. Run **Once (if missing)**. Then continue.
3. Compute `G` and `S`. Choose **exactly one** author half:
   - **Session catch-up** when `G > S + 20`. Follow [`loop-step-by-step.md`](loop-step-by-step.md) for its `next` problem. That slug **must** already have `content/guides/{slug}/` with `kind => 'algo'`. Create `content/coaching/{slug}/` (or skip `slug_exists`). Set `'related_guide'` on the session and `'related_session'` on the guide. Scan `content/games/` for a matching mini game (same slug, `related_session`/`related_guide` pointing here, or same `leetcode`); if found, set `'related_game'` on the new session and `'related_session'` on that game. If `next` has no algo guide, append step-by-step `skipped` with `"reason": "no_guide"` and advance `next` — do not create an unpaired session. Update [`loop-step-by-step.track.json`](loop-step-by-step.track.json). Do **not** run the algo-guides half.
   - **Guide catch-up** when `S > G + 20`. Follow [`loop-algo-guides.md`](loop-algo-guides.md) for its `next` problem. That slug **must** already have `content/coaching/{slug}/`. Create the algo guide (or skip `slug_exists`). Set both companion keys. Scan `content/games/` the same way; if a matching game exists, set `'related_game'` on the new guide and `'related_guide'` on that game. If `next` has no session, append algo-guides `skipped` with `"reason": "no_session"` and advance `next` — do not create an unpaired guide. Update [`loop-algo-guides.track.json`](loop-algo-guides.track.json). Do **not** run the step-by-step half.
   - **Default** otherwise. Follow [`loop-algo-guides.md`](loop-algo-guides.md) for exactly one `next` problem. If a session already exists for that slug, set both companion keys. If a matching mini game already exists, set `'related_game'` on the guide and `'related_guide'` on that game. If this loop is already exhausted, skip this half. Update [`loop-algo-guides.track.json`](loop-algo-guides.track.json). Do **not** run the step-by-step half.
4. **Pairing half** (intersection only while authors still run — no union / `no_pair` walk):
   - Pairable = algo-guide slugs ∩ coaching slugs, `LC_ALL=C` sort, not yet in pairing ledger `completed` / `already_linked`.
   - Prefer the slug just processed in the author half if it is pairable.
   - Otherwise take the first remaining pairable slug.
   - If none: do **not** append `"no_pair"`, do **not** set pairing `exhausted`. Set pairing `next` to `null`. Stop the pairing half.
   - If one: write both companion keys (or record `already_linked` / `skipped` with `"reason": "already_linked"`), advance pairing `next` to the next pairable slug or `null`, write [`loop-guide-step-links.track.json`](loop-guide-step-links.track.json) (pretty-printed, 2-space indent).
5. Stop. Do not start a second author problem or a second pair slug in this graph tick.

## Exhausted

| Child | Exhausted when |
|-------|----------------|
| Algo-guides | Its tracker `exhausted` is `true` (context queue finished) |
| Step-by-step | Its tracker `exhausted` is `true` |
| Pairing ledger | Both author loops are exhausted **and** no unlinked pair remains. Then leftover coaching-only / guide-only slugs may be recorded as `"no_pair"` and pairing `exhausted` set `true` |
| Graph | Both author children exhausted **and** pairing ledger exhausted |

While an author loop is still running, pairing stays `exhausted: false` even if the current intersection is fully linked — more pairs will appear.

## Skip secondary LeetCode writeups (`leetcode_exists`)

When a context item maps to LeetCode number `N` (path segment like `0001.Two Sum`, `28. Implement strStr()`, `problems/0001.…`), and **any** existing Algo Guide already has `'leetcode' => N`, the author half must **skip** with reason `leetcode_exists` and advance `next`. Do **not** create a second LC writeup from secondary repos (`leetcode-master`, `walkccc-leetcode`, `neetcode-leetcode`, `labuladong-algorithm`, …).

Same rule for Step-by-step catch-up/authoring: if any coaching session already has `'leetcode' => N`, skip `leetcode_exists`.

Non-LeetCode notes (hello-algo chapters, 剑指 Offer, theory/summary essays without a numbered LC id) stay in scope — omit `'leetcode'` and keep teaching them.


## Extras quality (Non-LeetCode Algo Guides)

Guides **without** `'leetcode' => N` (hello-algo chapters, 剑指 Offer, theory/summary essays) are **Extras**. They stay in scope — do not skip them as secondary LC dupes — but they must meet a higher teaching bar than a jargon dump or a shared quiz template.

When authoring or rewriting an Extra guide + its Step-by-step:

**Guide `body.md`**
- Teach **example-first**: a concrete tiny example with numbers/state before or with the abstract rule
- Explain **why** (what fails if you skip the idea), then **how** (clear steps)
- One **real** trap with the fix (not a vague slogan)
- Explicit **Time** / **Space**
- Plain English a learner can follow cold — no vibes, no filler
- **Readability:** put each step on its own Markdown list line (`1. …` / `2. …` or `- …`). Never pack `1. … 2. … 3. …` into one paragraph — the renderer turns real list lines into `<ol>`/`<ul>`
- Pipe tables (`| col |`) are supported; use them for small lookups. Do not fake a table inside a paragraph
- Prefer short paragraphs and labeled state (`vector = [10, 20]`) over dense prose
- **Summaries (guide + coaching `meta.php`):** write like a human list blurb — one clear sentence. Ban packed “AI catalog” lines: `15/20/30`, `high→low`, `Same bag … but … you still get 35`, em-dash lesson cram, or stuffing example + technique + answer into one breath. Put the walkthrough in the body/session, not the summary
- One Extra = one clear lesson. If two ideas belong together (e.g. growth vs mid-insert), separate them with headings and say how they differ — do not mash unrelated walkthroughs into one blob
- Keep `[!ui-builder]` blocks at the end if present
- Keep `kind => 'algo'`, omit `'leetcode'`; English only (translate Chinese titles/bodies)

**Session `tree.php`**
- **Topic-specific** decisions about *this* lesson’s example/state/trap — never a reusable skeleton reused across topics
- Walk the same example as the guide (or a sibling example) — do not jump topics mid-tree without stating the switch
- Put **state on separate lines** inside `message` (newlines are shown via `nl2br`) so the screen is skimmable
- At least one wrong-path leaf with `rewind_to` and a clear why-wrong message; a `success` leaf
- Concrete choice labels

**Ban list (never emit in Extra sessions)**
- "What do you focus on first?", "The core idea and when to use it", "Memorize code without the invariant"
- "Skip complexity; it never matters", "State one trap and the fix from the guide", "Assume the happy path only"
- "What is the key idea for: {title}?", or any identical tree pasted onto unrelated topics

Model quality: `content/guides/two-sum/` + `content/coaching/two-sum/tree.php`.

## Do not

- Run both `loop-algo-guides.md` and `loop-step-by-step.md` in the same graph tick
- Author a Step-by-step whose slug has no Algo Guide, or an Algo Guide whose slug has no session, during a **catch-up** half
- Run a standalone guide↔session links loop (retired; see `PROMPTS/archived/`)
- Process more than one context problem or more than one pair per graph tick
- Author a second numbered LeetCode guide/session when any page already has that `leetcode` number (`leetcode_exists`)
- Commit unless the user asks
