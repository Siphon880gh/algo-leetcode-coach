One table lists project assignments with an employee and a workload; another gives each employee’s name and team. Report the assignments whose workload is higher than the average workload of the employee’s team. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Team average

Using the column names the statement gives:

1. Join assignments to employees.
2. `AVG(workload) OVER (PARTITION BY team)` as av; keep workload > av, with the columns and order the statement asks.

Constructed check (run in SQLite): team A workloads 60 and 62 (average 61), team B 90, 12 and 100 (about 67.3) → 62, 90 and 100.

Average within the team: the overall average 64.8 drops the 62.

Time: O(n)  
Space: O(n)

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
