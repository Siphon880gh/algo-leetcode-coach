## Last number determines the state

1. `lcp[a][b]` = common prefix length of suffixes at `a` and `b` (fill from the back).
2. `dp[i][l]` (last number starts at `i`, length `l`): 0 if `num[i] == '0'`; 1 if `i == 0`; else `Σ_{k < l} dp[i − k][k]` plus `dp[i − l][l]` when `num[i − l : i] ≤ num[i : i + l]` (via `lcp`).
3. Keep running sums over `k` per end position so each state is O(1).
4. Answer = `Σ dp[i][n − i]`.

`"327"` → 2. `"094"` → 0. `"0"` → 0. Checked against brute-force splitting on random strings.

Comparing equal-length numbers digit by digit would make it O(n³). Leading zeros invalidate a number, so a `0` start contributes nothing.

Time: O(n²)  
Space: O(n²)

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
