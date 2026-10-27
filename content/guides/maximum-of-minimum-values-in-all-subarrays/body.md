Given an integer array nums of length n, answer n queries: for each i (0-indexed), return the maximum, over all subarrays of length i + 1, of that subarray's minimum. For instance, [0,1,2,4] → [4,2,1,0], and [10,20,50,10] → [50,20,10,10]. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Widest window per value

1. Monotonic stack: previous smaller `L[i]`, next smaller-or-equal `R[i]`; `w = R[i] − L[i] − 1`.
2. `ans[w − 1] = max(ans[w − 1], nums[i])`.
3. For `w` from `n − 2` down to 0: `ans[w] = max(ans[w], ans[w + 1])`.

Constructed checks (verified against brute force on random arrays): the two cases above.

Step 3 is essential: some sizes get no direct candidate, and a value that is the minimum of a wide window is also the minimum of some narrower one. Do not stop at equal values on both sides: in `[2, 2]` each copy would get width 1 and size 2 no candidate; stopping on one side only gives one copy the full width.

Time: O(n)  
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
