## Target is fixed

If `total % k ≠ 0` or the largest number exceeds `total / k`, return false. Let `target = total / k`.

**Backtracking:** sort descending (big numbers fail fast). Place `nums[i]` into each bucket with room. Prune:

- Skip a bucket whose current sum equals one already tried for this number; the results would be identical.
- If a bucket is empty and placing fails, stop; every other empty bucket would fail the same way.

**Bitmask DP (n ≤ 16):** `dp[mask]` = the current bucket's sum mod `target` for the used set `mask`, or −1 if unreachable. Adding number `i` is allowed when `dp[mask] + nums[i] ≤ target`. The answer is whether `dp[full] == 0`.

Do not fill one bucket at a time without memoization; the same used set gets revisited exponentially. Do not drop the empty-bucket prune; without it, the search repeats every bucket permutation.

Time: O(n · 2ⁿ) with the DP  
Space: O(2ⁿ)

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
