## Three parents per cell

`prev = matrix[0]`. For each later row `i`:

- `cur[j] = matrix[i][j] + min(prev[j − 1], prev[j], prev[j + 1])`, skipping neighbors outside the row.
- `prev = cur`.

Return `min(prev)`.

You can also update `matrix` in place, row by row, since each row only reads the one above.

Do not take a greedy minimum per row; the smallest cell now can lead into a costly area. Do not forget the edge columns have only two parents.

Time: O(n²)  
Space: O(n)

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
