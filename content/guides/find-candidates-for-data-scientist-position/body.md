A table lists candidates and their skills, one row per candidate and skill. Report the candidates who have every skill in the required list the statement names. Table, column and output names, the exact skills, and the ordering are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Relational division by counting

Using the column names the statement gives:

1. `WHERE skill IN (…the required skills…) GROUP BY candidate_id HAVING COUNT(DISTINCT skill) = <number of required skills>`, ordered as asked.

Constructed check (run in SQLite, with placeholder skills A, B, C required): candidate 1 has A, B, C; 2 has A, B; 3 has A, B, C, D; 4 has A, A, B → 1 and 3.

Count distinct skills: `COUNT(*) >= 3` also accepts candidate 4, whose A row is repeated.

Time: O(n)  
Space: O(number of candidates)

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
