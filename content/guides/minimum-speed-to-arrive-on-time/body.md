## Monotone feasibility

1. `time(v) = Σ ceil(d / v)` over all but the last ride, `+ last / v`.
2. Binary search the smallest `v` in `[1, 10^7]` with `time(v) ≤ hour`; none → −1.

`[1,3,2], 6` → 1. `[1,3,2], 2.7` → 3. `[1,3,2], 1.9` → −1.

If `hour ≤ n − 1` it is impossible, since the first n − 1 rides take at least an hour each. Compare with a small epsilon (or scale hour by 100 to integers) to avoid floating-point misses.

Time: O(n log 10^7)  
Space: O(1)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
