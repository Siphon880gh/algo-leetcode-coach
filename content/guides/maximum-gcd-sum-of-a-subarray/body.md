The gcd-sum of a subarray is the sum of its elements times the gcd of its elements. Given an array of positive integers and an integer k, return the largest gcd-sum among subarrays with at least k elements. Limits are in the official statement. For instance, [2, 1, 4, 4, 4, 2] with k = 2 → 48, and with k = 4 → 28. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Distinct gcds per right end

This assumes all values are positive, so for a fixed gcd the longest subarray has the largest sum.

1. Prefix sums.
2. Keep a list of (gcd, leftmost start) for subarrays ending at r: extend each with nums[r], add (nums[r], r), merge equal gcds keeping the leftmost start.
3. For each pair with `r − start + 1 ≥ k`, update the answer with `(pre[r + 1] − pre[start]) · gcd`.

Constructed checks (run in code): the examples above; [6, 3, 9] with k = 1 → 81; 1,500 random arrays match testing every subarray.

Each new gcd divides the previous one, so the list has at most about log2(max) + 1 entries.

Time: O(n log max)  
Space: O(log max)

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
