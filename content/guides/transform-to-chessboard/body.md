## Feasibility

Swapping rows or columns never changes which rows are equal or complementary. A chessboard has exactly two row types, complements of each other. So:

- For all `i, j`: `b[0][0] ^ b[i][0] ^ b[0][j] ^ b[i][j] == 0`. Otherwise return `-1`.
- The first row has `n // 2` or `(n + 1) // 2` ones, and so does the first column. Otherwise `-1`.

## Counting swaps

Rows and columns are independent. For the first row, count `m` = positions `i` where `b[0][i] ≠ i % 2` (mismatches against `0101…`).

- **Even n:** both patterns are possible. Moves = `min(m, n − m) / 2`.
- **Odd n:** only one pattern has the right count of ones. If `m` is odd, use `n − m`. Moves = that even value `/ 2`.

Each swap fixes two mismatches. Do the same with the first column and add the two results.

Do not BFS over boards; there are far too many. Do not count swaps on every row; once the first row and column are fixed, the rest follow.

Time: O(n²)  
Space: O(1)

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
