---
name: update-leetcode-urls
description: >-
  Use when updating the LeetCode url to LeetCode number map, refreshing
  context-leetcode-urls/data-cleaned.json or data-difficulty.json, when new
  LeetCode problems were released, or when LeetCode numbers in the app should
  open the LeetCode coding page in a tab. Pulls the public GraphQL problem list
  (no login, no pasted HTML).
---

# Update LeetCode urls to LeetCode numbers

This skill is **strictly** for refreshing the problem-number → URL and Easy/Med/Hard maps used by this app.

The map comes from LeetCode's **public** GraphQL problem list (`questionList` at `https://leetcode.com/graphql`). It needs no login and no cookies. **Never log in to LeetCode.** Do not invent URLs. Do not `Read()` `data-cleaned.json` or `data-difficulty.json` whole.

## Step 1 — report and preview

1. Say you are updating the LeetCode url to LeetCode number map.
2. Report the current largest number (max integer key of `context-leetcode-urls/data-cleaned.json`; unknown if the file is missing).
3. Preview what LeetCode has now, without writing:

```bash
python3 .agents/skills/update-leetcode-urls/scripts/fetch_list.py --dry-run
```

It pages the list (100 rows per request, 1.2 s apart, about a minute for ~4,100 problems) and prints the reported total, the new max, the added numbers, which added numbers are paid-only, and any gaps from 1 to the new max.

If the user only asked what is new, stop here and report. If they asked to update (or a drain needs the new numbers), continue.

## Step 2 — write the maps

```bash
python3 .agents/skills/update-leetcode-urls/scripts/fetch_list.py
```

- Writes `context-leetcode-urls/data-cleaned.json` (number → `https://leetcode.com/problems/{slug}`) and `context-leetcode-urls/data-difficulty.json` (number → `Easy` / `Med` / `Hard`).
- Existing entries are kept; new numbers are merged in and both files are rewritten sorted.
- It refuses to write when fewer rows came back than the reported total, or when an existing number now points at a different URL. A different URL for the same number is a stop-and-ask: report it to the user instead of forcing it.
- Report the count, the new largest number, the paid-only new numbers, and gaps (should be 0).

Paid-only numbers still get a URL and difficulty. Their statements are handled by `.agents/skills/fetch-leetcode-problems` (`premium.json` plus `build_premium.py` from the doocs clone).

### Legacy fallback (only if GraphQL is down)

`scripts/clean.py` still parses a pasted problem-table outerHTML at `context-leetcode-urls/data-input.html`. Use it only when the GraphQL list fails for several minutes and the user agrees to paste the HTML. Do not `Read()` that HTML file whole.

## Step 3 — links open the coding page in a tab

1. App lookup is `content_leetcode_url()` / `content_leetcode_difficulty()` in `includes/content.php`, which read `data-cleaned.json` and `data-difficulty.json`.
2. UI labels go through `content_leetcode_label_html()` / `content_leetcode_difficulty_html()` / `render_leetcode_row()` and the Browse panel. Number links must be `<a class="leetcode-link" href="{url}" target="_blank" rel="noopener noreferrer">` (never nested inside another `<a>`). Easy / Med / Hard sits on that same row, after the number.
3. If that wiring is missing, restore it. If only the JSON changed, a PHP lookup check is enough:

```bash
php -r 'require "includes/content.php"; echo content_leetcode_url(1), " ", content_leetcode_difficulty(1), "\n";'
```

4. Spot-check that a known number (for example 1 → two-sum) still matches the new map.
