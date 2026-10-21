A table Tasks records task_id, assignee_id and submit_date. Return one row with two counts: the number of tasks submitted on a weekend day (Saturday or Sunday) and the number submitted on a working day. For instance, six tasks spread over one Monday-to-Sunday week, three of them on the Saturday and Sunday → 3 and 3. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Two sums in one pass

Using the column names the statement gives:

1. `SELECT SUM(WEEKDAY(submit_date) >= 5), SUM(WEEKDAY(submit_date) < 5) FROM Tasks`, aliased as the statement asks.

Constructed check (run in SQLite with strftime %w, where 0 is Sunday; the week described above): 3, 3.

In MySQL `WEEKDAY` gives 0 for Monday through 6 for Sunday, while `DAYOFWEEK` gives 1 for Sunday through 7 for Saturday; the same `>= 5` test on `DAYOFWEEK` would count Thursday to Saturday instead.

Time: O(n)  
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
