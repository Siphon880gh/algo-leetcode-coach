## Columns as a knapsack

1. `cnt[k][c]` = how many words have letter `c` at column `k`.
2. `dp[0] = 1`.
3. For each column `k`: for `i` from `len(target) − 1` down to 0: `dp[i + 1] += dp[i] · cnt[k][target[i]]` (mod 1e9+7).
4. Return `dp[len(target)]`.

`["acca","bbbb","caca"]`, `"aba"` → 6. `["abba","baab"]`, `"bab"` → 4.

Iterate `i` downward so each column is used at most once. Do not loop over words inside the DP; the counts already merge them.

Time: O(L · (W + |target|))  
Space: O(26 · L + |target|)

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
