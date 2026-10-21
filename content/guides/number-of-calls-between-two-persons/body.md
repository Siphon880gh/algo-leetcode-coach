Given a calls table (caller, callee, duration), report for each unordered pair of people, listed with the smaller id first, the number of calls between them and their total duration, with the column names the statement specifies. For instance, calls 1 → 2 (60 s) and 2 → 1 (30 s) give the pair (1, 2) with 2 calls and 90 s. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Order the pair, then group

Using the column names the statement gives:

1. `SELECT LEAST(a, b) AS person1, GREATEST(a, b) AS person2, COUNT(*), SUM(duration)`
2. `FROM` calls `GROUP BY person1, person2`.

Constructed check: 1 → 2 (60), 2 → 1 (30), 3 → 1 (10) → (1, 2): 2 calls, 90; (1, 3): 1 call, 10.

Do not group by the raw (from, to); 1 → 2 and 2 → 1 would split. A `UNION ALL` of both orientations with a `from < to` filter is an alternative.

Time: O(rows)  
Space: O(pairs)

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
