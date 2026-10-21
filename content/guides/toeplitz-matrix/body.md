## Local check, global result

For `r ≥ 1` and `c ≥ 1`, require `matrix[r][c] == matrix[r − 1][c − 1]`. If every check passes, all diagonals are constant by induction along each diagonal.

Follow-ups:

- **Only one row in memory:** compare each new row with the previous row shifted by one: `row[1:] == prev[:-1]`.
- **Rows partially loaded:** the same comparison works on chunks of columns, with an overlap of one column between chunks.

Do not collect each diagonal into a list; the neighbor check needs no extra space. Do not compare the first row or column with anything; they start the diagonals.

Time: O(m · n)  
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
