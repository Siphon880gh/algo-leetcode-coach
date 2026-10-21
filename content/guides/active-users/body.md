An accounts table names users, and a logins table records login dates (possibly several per day). Report users who logged in on at least a given number of consecutive days (as the statement specifies), ordered by id. For instance, a user logging in on four straight days and then again after a gap has a longest streak of 4. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Gaps and islands

Using the column names the statement gives:

1. `SELECT DISTINCT id, login_date` first; repeat logins would break the run arithmetic.
2. `anchor = login_date − INTERVAL ROW_NUMBER() OVER (PARTITION BY id ORDER BY login_date) DAY`.
3. `GROUP BY id, anchor HAVING COUNT(*) ≥ threshold`; join accounts for names, DISTINCT ids, order by id.

Do not count total login days; they must be consecutive. A self-join on `DATEDIFF` between threshold − 1 days also works, but is heavier.

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
