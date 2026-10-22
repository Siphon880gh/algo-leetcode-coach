Split nums into contiguous subarrays so that, in every subarray, the GCD of its first and last elements is greater than 1. Return the fewest subarrays, or −1 if no valid split exists. For instance, [2,6,3,4,3] → 2, [3,5] → 2, and [1,2,1] → −1. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Try every last piece

1. `dp[0] = 0`; the rest ∞.
2. For `i = 1 … n`, for `j = 1 … i`: if `gcd(nums[j − 1], nums[i − 1]) > 1`, `dp[i] = min(dp[i], dp[j − 1] + 1)`.
3. Return `dp[n]`, or −1 if it is ∞.

Constructed checks (verified against trying every split on 300 random arrays): the cases above → 2, 2, −1.

Only the two ends of a piece matter, not its middle. A single number above 1 is a valid piece by itself, but a 1 can never be an end, so any 1 makes the split impossible.

Time: O(n² log V)  
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
