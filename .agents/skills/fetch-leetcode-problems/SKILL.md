---
name: fetch-leetcode-problems
description: >-
  Use when an Algo Guide or Step-by-step needs the official LeetCode problem
  statement, when content/problems/{n}.html is missing for a numbered LeetCode
  page, or when refreshing statements. Fetches from LeetCode's public GraphQL
  endpoint into a gitignored cache, then writes sanitized HTML that the app
  renders at the top of guides and sessions.
---

# Fetch LeetCode problem statements

Every numbered LeetCode page (`'leetcode' => N` in `meta.php`) shows the official problem statement at the top. The statement is stored **once per problem** and rendered by both page types through `includes/problem.php`:

| Path | Committed | What |
|------|-----------|------|
| `context/leetcode-problems/{N}.json` | no (gitignored via `/context/*`) | Raw GraphQL `question` response cache |
| `content/problems/{N}.html` | yes | Sanitized statement HTML (allowlisted tags only) |
| `content/problems/premium.json` | yes | Numbers whose statement is Premium-only (`isPaidOnly` or `content` null) |

## Workflow

From the repo root:

```bash
# one or more problems (skips numbers already cached)
python3 .agents/skills/fetch-leetcode-problems/scripts/fetch.py N [N ...]
# every guide/session in content/ (polite: 1.2 s between requests, retries with backoff)
python3 .agents/skills/fetch-leetcode-problems/scripts/fetch.py
# rebuild content/problems/ from the cache (all numbers used by content/)
python3 .agents/skills/fetch-leetcode-problems/scripts/build.py
# a new problem with no page yet: pass its number so it is built too
python3 .agents/skills/fetch-leetcode-problems/scripts/build.py N
```

Add `--refresh` to `fetch.py` to refetch cached numbers.

- The endpoint is `https://leetcode.com/graphql` with `question(titleSlug)`; the title slug comes from `context-leetcode-urls/data-cleaned.json`. Free problems need no login.
- **Never log in** or use cookies to get Premium statements. Premium numbers go to `premium.json`; the page shows a short "Premium" notice and the learner relies on the page's own brief restatement (keep it in `body.md` / the first step for those problems).
- `build.py` keeps `p br strong b em i u s code pre ul ol li sup sub img table thead tbody tr th td div span blockquote hr kbd var`, drops every attribute except `img` `src` (https only) and `alt`, removes scripts/styles, empty spacer paragraphs, NBSP, and zero-width spaces. Examples, constraints, follow-ups, `<sup>`/`<sub>`, and `<code>`/`<pre>` are preserved.
- Do not hand-edit `content/problems/*.html`; rerun `build.py`.

## Authoring rules that depend on this

- Fetch and build the statement **before** writing a new guide or session (see `PROMPTS/loop-algo-guides.md`, `PROMPTS/loop-step-by-step.md`).
- Free problems: do not restate the problem in `body.md` or in the session `start` message; the statement is already rendered above. Open the guide with the approach, and open the session with "Read the problem statement above." plus the first decision.
- Premium problems: keep a short original-wording restatement (inputs, output, one example, key constraints) at the top of `body.md` and in the session `start` message.

## Hidden premium pages and full premium statements

- Premium guides and sessions are hidden from web visitors until they unlock with the footer key (`unlock.php`, password `PREMIUM_PASSWORD` in `.env`). `includes/premium.php` filters them in `list_content()` / `load_content()`; the CLI always sees everything.
- For unlocked visitors, `includes/problem.php` shows the full statement from `content/problems/premium/{n}.php` (gitignored), built from the doocs clone with:

```bash
python3 .agents/skills/fetch-leetcode-problems/scripts/build_premium.py        # premium numbers that have pages
python3 .agents/skills/fetch-leetcode-problems/scripts/build_premium.py --all  # every number in premium.json
```

- It copies only the `description:start … description:end` block of `README_EN.md` (no solutions), sanitized like `build.py`. Rerun it after new premium pages are added. Keep writing the short restatement on premium pages; locked builds and fresh clones without the doocs output still rely on it.
