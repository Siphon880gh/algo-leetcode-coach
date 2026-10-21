One table gives each task and its number of subtasks (numbered from 1 up to that count); another lists the (task, subtask) pairs that were executed. Report every (task, subtask) pair that was not executed, with the column names the statement specifies. For instance, task 1 with 3 subtasks of which only subtask 2 ran, and task 2 with 2 subtasks that both ran, give (1, 1) and (1, 3). _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Expand, then subtract

Using the column names the statement gives:

1. `WITH RECURSIVE s AS (SELECT task, 1 AS sub, cnt FROM tasks UNION ALL SELECT task, sub + 1, cnt FROM s WHERE sub < cnt)`.
2. `s LEFT JOIN executed e ON e.task = s.task AND e.sub = s.sub WHERE e.task IS NULL`.

Constructed check (run in SQLite): task 1 (3 subtasks, only 2 ran), task 2 (2, both ran), task 3 (1, ran) → (1, 1), (1, 3).

Carry the count through the recursion so each task stops at its own limit. `NOT EXISTS` works in place of the left join.

Time: O(total subtasks)  
Space: O(total subtasks)

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
