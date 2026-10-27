## Window of costs

1. `l = 0`, `cost = 0`, `best = 0`.
2. For each `r`: `cost += |s[r] − t[r]|`; while `cost > maxCost`: subtract the cost at `l` and `l += 1`; `best = max(best, r − l + 1)`.
3. Return `best`.

`"abcd"`, `"bcdf"`, 3 → 3. `"abcd"`, `"cdef"`, 3 → 1. `"abcd"`, `"acde"`, 0 → 1.

All costs are non-negative, so shrinking from the left always lowers the cost.

Do not use a subsequence; the positions must be contiguous and aligned in both strings. Do not reset the window on an expensive character; shrink it.

Time: O(n)  
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
