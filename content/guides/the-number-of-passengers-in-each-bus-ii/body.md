A buses table lists each bus id, its arrival time and its capacity; a passengers table lists each passenger id and arrival time. When a bus arrives, waiting passengers (those who have arrived by then and not yet boarded) get on, up to the bus capacity; the rest keep waiting for later buses, following the boarding rule the statement gives. Report how many passengers board each bus. For instance, buses 1, 2, 3 arriving at 2, 4, 7 with capacities 1, 10, 2 and passengers arriving at 1, 1, 5, 6, 7 → buses carry 1, 1, 2. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## A running total of boarded passengers

Using the column names the statement gives: take the boarding rule and output order from it too.

1. Number the buses by arrival time; for each, `arrived` = passengers with arrival time ≤ the bus time.
2. Recursive CTE over that order: `took = MIN(capacity, arrived − total)`, `total += took`.
3. Output each bus with `took`.

Constructed check (run in SQLite, the example above): (1, 1), (2, 1), (3, 2).

Each bus depends on how many earlier buses already took, which plain aggregation cannot express; that is why the running total needs recursion or ordered variables.

Time: O(B · P) as written  
Space: O(B)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
