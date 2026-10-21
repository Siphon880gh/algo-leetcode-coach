A randomised search picks any remaining element as the pivot: if it equals the target it stops; if it is smaller, everything to its left (and itself) is discarded; if larger, everything to its right (and itself) is discarded. Given an array of distinct integers, count the values that are found for every possible sequence of pivot choices. For instance, [7] → 1, [-1,5,2] → 1, and [1,3,2,4,6,5] → 2. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Locally sorted position

1. `L[i]` = max of `a[0 … i − 1]`; `R[i]` = min of `a[i + 1 … n − 1]`.
2. Count `i` with `L[i] < a[i] < R[i]`.

Constructed checks (verified by simulating every pivot sequence on random arrays): the three cases above → 1, 1, 2.

If some larger value `y` sits left of `x`, picking `y` as pivot discards its right side, including `x`. Distinct values remove tie concerns.

Time: O(n)  
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
