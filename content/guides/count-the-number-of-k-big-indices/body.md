Given an integer array nums and an integer k, an index i is k-big when at least k earlier elements and at least k later elements are smaller than nums[i]. Count the k-big indices. For instance, [2,3,6,5,2,3] with k = 2 → 2 (the values 6 and 5); [1,1,1] with k = 1 → 0. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Two sweeps

1. Compress values to ranks.
2. Left to right: `L[i]` = count of ranks below `nums[i]` so far; insert `nums[i]`.
3. Right to left with a fresh tree: if `L[i] ≥ k` and the count of ranks below `nums[i]` so far is `≥ k`, count `i`; insert `nums[i]`.

Constructed checks (verified against counting both sides directly on 400 random arrays): the cases above → 2, 0.

Count strictly smaller values, so equal values never help. A max-heap of size k per side, holding the k smallest values seen so far, is a shorter alternative.

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
