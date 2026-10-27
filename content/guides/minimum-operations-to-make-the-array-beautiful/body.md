You are given an array of positive integers. The array is beautiful when every element after the first is divisible by the element before it. In one operation you may add 1 to any element except the first. Return the fewest operations that make the array beautiful. This guide assumes the values are small, as in the official limits. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## DP over values

1. B = 2 · max(nums) (assumption: the values are small, so this bound is enough; checked against a bound of 8 · max in code).
2. f = {nums[0]: 0}.
3. For each next x: for each (p, c) in f, for v = the multiples of p from the first one ≥ x up to B: g[v] = min(g[v], c + v − x). f = g.
4. Return min(f).

Constructed checks (made-up values, run in code): [2, 5] → 1; [6, 4] → 2; [5] → 0; [1, 3, 4] → 1. Checked against the larger bound on 3,000 random arrays.

Rounding each element up to the next multiple of the one before: [1, 3, 4] → 2 instead of 1 (raising 3 to 4 is cheaper).

Time: O(n · B log B)  
Space: O(B)

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
