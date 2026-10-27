You get an integer array. In one move you take any element out and put it at the end of the array. Find the fewest moves that make every prefix sum non-negative. The exact limits and guarantees are in the official statement. For instance, [2,−3,−1,4] → 1 (move −3 to the end), and [3,−5,−4,6,2] → 2. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Undo the worst drop

1. `s = 0`, `moves = 0`, empty min-heap.
2. For each `x`: `s += x`; if `x < 0`, push it. If `s < 0`: pop the smallest `y`, `s −= y`, `moves++`.
3. Return `moves`.

Constructed checks (verified against a breadth-first search over arrangements on 218 random small arrays): the cases above → 1, 2.

Elements moved to the end come after everything else, and the total is not negative there, so they never break a later prefix. Removing the most negative value fixes the sum with one move and leaves the most room for later. Sums can exceed 32-bit, so use 64-bit.

Time: O(n log n)  
Space: O(n)

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
