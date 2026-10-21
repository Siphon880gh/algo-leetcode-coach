Given a user-visits table (user id, visit date), report for each user the largest number of days between consecutive visits, counting the gap from the last visit to a fixed end date the statement gives, ordered as the statement specifies. For instance, with visits on 2020-11-28 and 2020-12-03 and an end date of 2020-12-31, the windows are 5 and 28, so the answer is 28. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Next visit or the end date

Using the column names the statement gives:

1. `LEAD(visit_date, 1, end_date) OVER (PARTITION BY user ORDER BY visit_date) AS nxt`.
2. `DATEDIFF(nxt, visit_date)` per row.
3. `MAX` of that per user; order as required.

Constructed check: 2020-11-28, 2020-12-03, end 2020-12-31 → gaps 5, 28 → 28.

Do not forget the final window to the end date. Repeated visits on one day give a 0 window, which is fine.

Time: O(rows log rows)  
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
