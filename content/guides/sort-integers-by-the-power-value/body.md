## Memo plus sort

1. `power(1) = 0`; `power(x) = 1 + power(x / 2)` if even, else `1 + power(3x + 1)`; memoize.
2. Sort `lo..hi` by `(power(x), x)`; return index `k − 1`.

`lo = 12, hi = 15, k = 2` → 13. `lo = 7, hi = 11, k = 4` → 7.

Do not recompute shared tails for every number; memoization reuses them. Do not break ties by larger value; ties go to the smaller number.

Time: O(range · log range + Collatz work)  
Space: O(memo)

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
