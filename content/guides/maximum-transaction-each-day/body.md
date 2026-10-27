A transactions table lists each transaction's id, a date-time and an amount. Report the ids of the transactions with the largest amount on their calendar day, including all ties, in the order the statement specifies. For instance, transactions (1, day 1 10:00, 50), (2, day 1 18:00, 50), (3, day 1 12:00, 20) and (4, day 2 09:00, 30) give 1, 2 and 4. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Per-day maximum

Using the column names the statement gives:

1. `RANK() OVER (PARTITION BY DATE(<timestamp>) ORDER BY <amount> DESC)`.
2. Keep rank 1; select the id; order as required.

Constructed check (run in SQLite): the example above → 1, 2, 4.

Partition by the date, not the full timestamp, or every transaction is its own group. Use `RANK` (or `DENSE_RANK`), not `ROW_NUMBER`, so ties are all kept.

Time: O(rows log rows)  
Space: O(rows)

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
