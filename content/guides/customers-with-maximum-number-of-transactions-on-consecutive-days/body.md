A transactions table records which customer made a transaction on which date. For each customer, find their longest run of transactions on consecutive days, then report the customers whose run is the longest of all, ordered as the statement says. The exact columns, whether a customer can have several transactions on one day, and the output names are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Islands

Using the column names the statement gives:

1. Per customer, ordered by date: `key = date − ROW_NUMBER()` (in days).
2. Count rows per (customer, key); that is each run’s length.
3. Keep customers whose run length equals the maximum over all runs.

Constructed check (run in SQLite): customer 1 on May 1–3, customer 2 on May 1, 3, 4, customer 3 on May 10–12 → customers 1 and 3.

Counting all of a customer’s transactions ignores the gaps: customer 2 also has 3 rows, so it wrongly joins → 1, 2, 3. If one customer can have two transactions on a day, take distinct dates first so a repeat does not break the run.

Time: O(n log n)  
Space: O(n)

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
