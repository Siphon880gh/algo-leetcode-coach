## Prefix sums as gains

1. Sort descending; `prefix = 0`, `total = 0`.
2. For each `x`: if `prefix + x ≤ 0`, stop; else `prefix += x`, `total += prefix`.

`[-1,-8,0,5,-9]` → 14. `[4,3,2]` → 20. `[-1,-4,-5]` → 0.

Do not drop all negative dishes; a small negative can still pay off by delaying better dishes. Do not sort ascending and stop at the first negative; the stopping test is on the prefix sum.

Time: O(n log n)  
Space: O(1)

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
