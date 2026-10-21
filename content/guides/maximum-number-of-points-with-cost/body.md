## Remove the absolute value

1. `dp = points[0]`.
2. For each next row: `L[c] = max(L[c − 1] − 1, dp[c])`; `R[c] = max(R[c + 1] − 1, dp[c])`.
3. `dp[c] = row[c] + max(L[c], R[c])`.
4. Return `max(dp)`.

Example 1 → 9. Example 2 → 11. Checked against the O(n²)-per-row DP on random grids.

The naive transition is O(n²) per row, too slow when n is 10^5. Values reach about 10^10, so use 64-bit.

Time: O(m · n)  
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
