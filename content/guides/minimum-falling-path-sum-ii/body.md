## Two minima per row

1. `prev = grid[0]`.
2. For each next row, find the column `m1` with the smallest `prev` and the second-smallest value.
3. `cur[j] = row[j] + (j ≠ m1 ? prev[m1] : second)`.
4. Return `min(prev)` after the last row.

`[[1,2,3],[4,5,6],[7,8,9]]` → 13 (1 + 5 + 7). `[[7]]` → 7.

Do not scan every previous column for each cell; that is O(n³). Do not drop the second minimum; the best column can repeat.

Time: O(n²)  
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
