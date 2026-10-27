## Assign nums1 in order

1. `dp[0] = 0`, all others ∞.
2. For each `mask`, `i = popcount(mask)`; for each `j` not in `mask`: `dp[mask | 1 << j] = min(…, dp[mask] + (nums1[i] XOR nums2[j]))`.
3. Return `dp[(1 << n) − 1]`.

`[1,2], [2,3]` → 2. `[1,0,3], [5,3,4]` → 8.

Greedy matching of equal or close values fails in general; this is an assignment problem. 2^14 · 14 transitions are tiny.

Time: O(2^n · n)  
Space: O(2^n)

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
