A variables table gives each variable's value, and an expressions table holds comparisons of the form left operand, operator (one of a few comparison symbols), right operand, both being variable names. Report each expression with its result as the statement specifies (true or false). _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Two joins

Using the column names the statement gives:

1. `JOIN Variables l ON e.left_operand = l.name`.
2. `JOIN Variables r ON e.right_operand = r.name`.
3. `CASE WHEN operator = '>' THEN l.value > r.value WHEN '<' … WHEN '=' … END`, mapped to the required output strings.

For instance, x = 66 and y = 77 make `x < y` true and `x = y` false.

Do not join once and look up the second operand with a subquery per row; two joins are simpler. Do not compare variable names instead of values.

Time: O(rows) with indexed names  
Space: O(rows)

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
