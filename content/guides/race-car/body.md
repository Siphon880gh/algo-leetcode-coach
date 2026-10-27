## Shortest path over states

From `(pos, speed)`:

- `A` → `(pos + speed, speed · 2)`.
- `R` → `(pos, −1 if speed > 0 else 1)`.

BFS from `(0, 1)` until `pos == target`. Prune with a visited set and keep `|pos| ≤ 2 · target` roughly (going much beyond the target is never useful). A common pruning reverses only when the car has passed the target or is moving away from it.

**DP alternative:** `dp[t]` = the fewest instructions to reach `t`. Let `n` be the bit length of `t`.

- If `t == 2ⁿ − 1`, `dp[t] = n` (all A).
- Overshoot: `n` A's reach `2ⁿ − 1`, reverse, then cover the rest: `n + 1 + dp[2ⁿ − 1 − t]`.
- Undershoot: `n − 1` A's, reverse, `m` A's backward (`m < n − 1`), reverse, then `dp[t − (2^(n−1) − 1) + (2^m − 1)]`, costing `(n − 1) + 1 + m + 1` plus that.

Do not BFS without bounds; positions grow exponentially. Do not forget that R resets the speed to 1 in the opposite direction, not to 0.

Time: O(t log t) with the DP  
Space: O(t)

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
