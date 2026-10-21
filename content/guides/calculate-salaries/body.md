A salaries table lists each company's employees and salaries. Each company's tax rate depends on its maximum salary (thresholds as the statement specifies). Report every employee's salary after tax, rounded as the statement specifies. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Rate per company, applied per row

Using the column names the statement gives:

1. `MAX(salary) OVER (PARTITION BY company_id)` as `mx`.
2. `rate = CASE WHEN mx < low THEN 0 WHEN mx <= high THEN r1 ELSE r2 END` with the statement's thresholds.
3. `ROUND(salary * (1 − rate))`, rounding as required.

Do not compute the rate from each employee's own salary; it is set by the company max. Watch the inclusive and exclusive edges of the thresholds.

Time: O(rows)  
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
