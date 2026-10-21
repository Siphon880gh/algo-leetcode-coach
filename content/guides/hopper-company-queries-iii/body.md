Using the Hopper Company ride tables, report for each three-month window of 2020 (starting January through October) the average monthly ride distance and ride duration over that window, rounded as the statement specifies. For instance, monthly distances 30, 0, 60 for January to March give a January window average of 30. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Monthly totals, then a window

Using the column names the statement gives:

1. Recursive CTE for months 1 … 12.
2. Left join per-month sums of accepted-ride distance and duration in 2020; `COALESCE` to 0.
3. `AVG(x) OVER (ORDER BY month ROWS BETWEEN CURRENT ROW AND 2 FOLLOWING)`, keep months 1 … 10, round.

Constructed check: distances 30, 0, 60 for months 1–3 → window 1 average 30.00.

Empty months must count as 0 in the average; that is why the calendar comes first. Do not average individual rides; average the monthly totals.

Time: O(rows + 12)  
Space: O(12)

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
