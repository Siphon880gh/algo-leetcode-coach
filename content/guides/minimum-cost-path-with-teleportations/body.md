## k + 1 layers

1. Sort cells by value descending once.
2. Layer 0: plain right/down DP.
3. Layer t: tp[cell] = min of layer t − 1 over cells with value ≥ grid[cell] (a running minimum over the sorted cells, sharing it across equal values). Then dp[i][j] = min(tp, dp[i − 1][j] + grid[i][j], dp[i][j − 1] + grid[i][j]).
4. Answer layer k at the bottom-right.

Examples → 7, 9. Checked against Dijkstra over (cell, teleports used) on 600 random grids.

Only teleporting to strictly smaller values: example 1 → 11 instead of 7.

Time: O(m · n · (k + log(m · n)))  
Space: O(m · n)

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
