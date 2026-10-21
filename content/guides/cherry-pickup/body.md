## Why not two greedy passes

Taking the best path down and then the best path back can be wrong: the first path may waste cherries the second one needed. Optimize both paths together.

After `t` steps, walker A is at `(r1, t − r1)` and walker B at `(r2, t − r2)`. Let `dp[r1][r2]` be the most cherries for this `t`.

For each step `t` from 1 to `2(n − 1)`, compute from the four combinations of previous rows (each walker came from above or from the left):

- Skip if either cell is out of range or is a thorn (`−1`).
- Gain `grid[r1][c1]`, plus `grid[r2][c2]` if the cells differ.
- `dp[r1][r2] = gain + max(previous dp over the four combinations)`.

Return `max(0, dp[n − 1][n − 1])` at the last step; use −∞ for unreachable states.

Do not count a shared cell twice. Do not run two separate maximum paths.

Time: O(n³)  
Space: O(n²) by rolling over t

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
