## Periodic structure

1. Sliding a window by one swaps `nums[i]` for `nums[i + k]`, so they must be equal: each class `i mod k` gets one value.
2. `dp[0] = 0`, others ∞. For group `g` with counts `c` and size `sz`:
   - `nd[x] = min(dp) + sz` for all `x` (change the whole group to a fresh value);
   - for each `x` and each value `v` present: `nd[x ^ v] = min(nd[x ^ v], dp[x] + sz − c[v])`.
3. Answer `dp[0]` after all `k` groups.

Example 1 → 3. Example 2 → 3. Example 3 → 3.

Values are below 2^10, so states fit in 1024. The "whole group" option is what keeps this fast: no need to try all 1024 values per group.

Time: O(1024 · n)  
Space: O(1024)

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
