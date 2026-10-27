## Collinearity test

1. Sort by day. If `n = 1`, return 0.
2. `lines = 1`; for each `i ≥ 2`: if `(y1 − y0)(x2 − x1) ≠ (y2 − y1)(x1 − x0)` for points `i − 2, i − 1, i`, `lines++`.

Examples → 3, 1.

Days and prices reach 10^9, so products reach 10^18 and fit in 64-bit, while floating-point slopes of nearly equal fractions can compare equal by mistake. Example 2 arrives unsorted and lies on one line once sorted.

Time: O(n log n)  
Space: O(1) beyond sorting

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
