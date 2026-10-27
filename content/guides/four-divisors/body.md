## Pairs of divisors

1. For each `x`: for `d` from 1 to `√x`, if `x mod d == 0`, add `d` and `x / d` to a set; stop if the set exceeds 4.
2. If the set has exactly 4 elements, add their sum.

`[21,4,7]` → 32 (1 + 3 + 7 + 21). `[21,21]` → 64. `[1,2,3,4,5]` → 0.

Do not count a square root twice; a set handles `d = x / d`. Do not scan to `x`; `√x` suffices.

Time: O(n · √max)  
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
