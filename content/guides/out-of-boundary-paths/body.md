## Ways per cell, move by move

Let `f[i][j]` be the number of ways to stand on `(i, j)` after the moves made so far. Start with `f[startRow][startColumn] = 1`.

Repeat `maxMove` times:

1. Make a fresh grid `g` of zeros.
2. For each cell with `f[i][j] > 0` and each of the four directions: if the neighbor is outside, add `f[i][j]` to the answer; otherwise add it to `g` at the neighbor.
3. Set `f = g`.

Take everything modulo `1e9 + 7`. The memoized form `dfs(i, j, k)` (k moves left: return 1 when off the grid, 0 when `k == 0`) gives the same counts.

Do not stop a path once it leaves; count it once and end it there. Do not forget the modulus, since the counts grow quickly.

Time: O(maxMove · m · n)  
Space: O(m · n)

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
