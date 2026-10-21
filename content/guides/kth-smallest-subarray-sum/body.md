Given an array of positive integers and an integer k, return the k-th smallest sum among all non-empty subarrays (counting each subarray separately). For instance, [2,1,3] with k = 4 → 3, and [3,3,5,5] with k = 7 → 10. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Count sums ≤ x

1. `count(x)`: sliding window; for each right end, shrink while the sum exceeds `x`; add the window length.
2. Smallest `x` in `[min(nums), sum(nums)]` with `count(x) ≥ k`.

Constructed checks (verified against sorting all subarray sums on random arrays): the two cases above → 3 and 10.

Positivity is what makes the window valid. The smallest `x` with enough sums is always an actual subarray sum.

Time: O(n log(sum))  
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
