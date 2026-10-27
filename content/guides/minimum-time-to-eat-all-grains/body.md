Hens and grains sit at integer positions on a line. Every second each hen may move one unit left or right, all hens moving at once, and a hen eats every grain it reaches; one hen can eat many grains. Find the minimum time until every grain is eaten. The exact limits are in the official statement. For instance, hens [3] and grains [1,5] → 6, and hens [3,6] with grains [1,7] → 2. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Search on t

1. Sort hens and grains.
2. `ok(t)`: `j` = first uneaten grain. For each hen at `p`: if grain `j` is left of `p` at distance `d`, fail when `d > t`, else its reach is `p + max(t − 2d, (t − d) / 2)`; otherwise its reach is `p + t`. Advance `j` past every grain `≤` reach.
3. `ok(t)` is true when `j` passes every grain; binary search the smallest such t.

Constructed checks (verified against splitting the sorted grains among sorted hens in every way on 500 random cases): the cases above → 6, 2.

The leftmost uneaten grain has no hen further left to take it. Going left first then right costs 2d plus the right distance; going right first costs twice the right distance plus d. Positions can be large, so use 64-bit.

Time: O((h + g) log range + h log h + g log g)  
Space: O(1) besides sorting

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
