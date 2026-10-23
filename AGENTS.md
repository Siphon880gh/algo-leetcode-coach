# Agent instructions

Read this file before starting any drain or author work in this repo. Detailed tick rules live under [`PROMPTS/`](PROMPTS/); this file is the **task menu** and **how to report**.

## Prompt tasks you can run

| Task | When to use | Follow |
|------|-------------|--------|
| **Graph drain (default)** | Add Algo Guides + Step-by-steps, keep them balanced, **and pair them** (`related_session` / `related_guide`) as you go | [`PROMPTS/graph-guides-and-links.md`](PROMPTS/graph-guides-and-links.md) |
| **Mini games** | Create playable games from `context/` when there is one clear interactive mechanic. Link each game to its Algo Guide and, if it exists, its Step-by-step | [`PROMPTS/loop-mini-games.md`](PROMPTS/loop-mini-games.md) |

There is **no** separate Guide ↔ session links task. The graph owns that pairing. Mini games own game ↔ guide / session linking.

Rare (prefer the graph instead): solo [`loop-algo-guides.md`](PROMPTS/loop-algo-guides.md) or [`loop-step-by-step.md`](PROMPTS/loop-step-by-step.md). Those still set companion keys when the other side already exists, but they do not replace the graph.

A loop is **drained** when its `.track.json` has `"exhausted": true` and `"next": null`. The graph is drained when both author trackers and the pairing ledger are exhausted.

### Trackers

| Prompt | Tracker |
|--------|---------|
| Graph (authors + pairing) | [`loop-algo-guides.track.json`](PROMPTS/loop-algo-guides.track.json), [`loop-step-by-step.track.json`](PROMPTS/loop-step-by-step.track.json), pairing ledger [`loop-guide-step-links.track.json`](PROMPTS/loop-guide-step-links.track.json) |
| Mini games | [`PROMPTS/loop-mini-games.track.json`](PROMPTS/loop-mini-games.track.json) |

## Leet problem numbers (primary progress frame)

For numbered LeetCode work, progress is **problem numbers**, not context-repo slug counts.

- Numbered pages set `'leetcode' => N` and `'difficulty'` (`Easy` \| `Med` \| `Hard`) from `context-leetcode-urls/data-difficulty.json`.
- A problem is in scope when a statement exists: `content/problems/{N}.html` or `N` in `content/problems/premium.json` (fetch via `.agents/skills/fetch-leetcode-problems`; never log in to LeetCode).
- Balance **Algo Guides** and **Step-by-steps** so both cover the same number range. The graph keeps total counts `G` and `S` within 20; catch-up authors the lagging companion for a slug that already has the leading side, then pairs them.
- “Drain all the way” for Leet content means: guides and sessions both reach the **last problem with a statement available** (currently **4041**), with pairing/chrome checks passing for locked and unlocked as applicable.

Never author a second numbered LeetCode guide/session when any page already has that `leetcode` number (skip `leetcode_exists` in the graph/author prompts). Context libraries under `context/` (doocs, hello-algo, …) are the **source queue** for author loops. Reporting still leads with Leet numbers when the batch is numbered problems.


## Extras (Non-LeetCode) quality

Algo Guides without `'leetcode' => N` are Extras. Author/rewrite them example-first with a real trap and Time/Space; pair with a **topic-specific** Step-by-step (same example, wrong path + `rewind_to`, success). Prefer real Markdown lists (one step per line), skimmable session state lines, and human meta summaries (no slash/arrow “AI catalog” blurbs). Never reuse a shared quiz template across Extras. Details: [`PROMPTS/graph-guides-and-links.md`](PROMPTS/graph-guides-and-links.md) § Extras quality. Model Extra: `content/guides/vector/` + `content/coaching/vector/`; LC model still `two-sum`.

## How to report a drain batch

Lead with whether the drain finished (and whether it was pushed — only if the user asked you to push). Then:

1. How far Algo Guides and Step-by-steps reached in **Leet problem numbers** (e.g. both through 4041).
2. Checks: what passed (e.g. locked and unlocked), briefly.
3. This batch only: number ranges for guides and for step-by-steps, then page count, file count, and line count.

Example shape:

```text
The drain is finished and pushed. Algo guides and step-by-steps now both go all
the way to 4041, the last problem with a statement available. Every check
passed, both locked and unlocked.

This batch: guides 4003–4041 and step-by-steps 3983–4041. That's 98 pages
across 216 files and 5,380 lines.
```

After every implementation: list files changed, how many lines changed, and offer `git diff` (or `--stat`). Do **not** commit, push, or open a PR unless the user asks.

## Local work only

All code changes are on this Mac checkout. Do not use cloud coding agents for this repo.
