## 2^(2n) states

1. Precompute `g[i][j] = gcd(nums[i], nums[j])`.
2. For each `mask` with an even number of bits, `k = popcount(mask) / 2 + 1`.
3. Take the lowest unused `i`; for each unused `j > i`: `dp[mask | i | j] = max(…, dp[mask] + k · g[i][j])`.
4. Answer `dp[full]`.

`[1,2]` → 1. `[3,4,6,8]` → 11. `[1,2,3,4,5,6]` → 14.

Fixing the lowest unused element avoids counting the same pairing in many orders. Do not greedily give the biggest gcd the last operation; pairs interact.

Time: O(2^(2n) · n)  
Space: O(2^(2n))

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
