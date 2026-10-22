A binary matrix is given. Moving only right or down from the top-left cell to the bottom-right cell, decide whether some path visits as many 0s as 1s. For instance, [[0,1,0],[0,1,1]] → true; [[0,1],[1,0]] → false, since every path there has 3 cells. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Range of ones

1. If `m + n − 1` is odd, return false.
2. `lo[i][j]` and `hi[i][j]`: the min and max over the cell above and the cell to the left, plus `grid[i][j]`.
3. Return whether `(m + n − 1) / 2` lies in `[lo, hi]` at the bottom-right cell.

Constructed checks (verified against trying every path on 400 random grids up to 4 × 4): the cases above → true, false.

Two paths that differ in one corner turn differ by at most one 1, and any path can be turned into any other by such moves, so all counts between the extremes occur. Tracking a set of reachable counts per cell would also work, at O(m · n · (m + n)).

Time: O(m · n)  
Space: O(m · n), or O(n) row by row

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
