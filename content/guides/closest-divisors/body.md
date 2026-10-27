## From √x downward

1. For `x` in `{num + 1, num + 2}`: `d = floor(√x)`; decrease until `x mod d == 0`.
2. Keep the pair `(d, x / d)` with the smaller gap.

`8` → `[3,3]` (9). `123` → `[5,25]` (125). `999` → `[25,40]` (1000), in any order.

Do not scan upward from 1; the first divisor near the root is the closest. Do not test only `num + 1`; `num + 2` may be closer.

Time: O(√num)  
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
