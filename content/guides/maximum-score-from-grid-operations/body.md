## Heights DP

1. h_j ∈ 0 … n is the painted height of column j. Column j scores the white cells from h_j up to max(h_{j−1}, h_{j+1}) − 1, from column prefix sums.
2. dp[a][b] = best total of columns before j with h_{j−1} = a, h_j = b. Moving to h_{j+1} = c adds column j’s score with top max(a, c).
3. For fixed b, split a ≥ c (suffix maximum of dp[a][b] + score(b, a)) and a < c (prefix maximum of dp[a][b], plus score(b, c)).

Examples → 11, 94. Checked against trying every set of heights on 120 random grids up to 4 × 4.

Scoring a cell once per taller neighbour double-counts it: example 1 → 14 instead of 11. Sums reach about 10^13; use 64-bit.

Time: O(n³)  
Space: O(n²)

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
