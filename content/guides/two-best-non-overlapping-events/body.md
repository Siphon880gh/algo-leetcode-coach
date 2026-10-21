## Best partner after the end

1. Sort by start; `starts` = their start times; `suf[i]` = max value among events `i …`.
2. For each event `(s, e, v)`: `j = bisect_right(starts, e)` (first start ≥ e + 1); `best = max(best, v + suf[j])` with `suf[n] = 0`.

Examples → 4, 5, 8. Checked against every pair on random inputs.

Times are inclusive, so the partner must start at `e + 1` or later; `bisect_right` on `e` does exactly that. Taking a single event is covered by `suf[n] = 0`. A sweep with a min-heap of end times is an equivalent alternative.

Time: O(n log n)  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
