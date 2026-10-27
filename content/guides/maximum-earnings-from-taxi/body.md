## Linear DP on positions

1. `byEnd[e]` = list of `(s, e − s + tip)`.
2. `dp[0 … n] = 0`; for `i` from 1 to `n`: `dp[i] = dp[i − 1]`, then `dp[i] = max(dp[i], dp[s] + gain)` for each ride ending at `i`.
3. Return `dp[n]`.

Examples → 7, 20. Checked against trying every compatible ride set on random inputs.

Drop-off and pick-up at the same point are allowed, so a ride starting at `s` may follow one ending at `s`, which `dp[s]` already covers. Use 64-bit: 3 · 10^4 tips of up to 10^5 can total 3 · 10^9, beyond 32 bits. Sorting rides by end with binary search gives an O(m log m) version independent of `n`.

Time: O(n + m)  
Space: O(n + m)

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
