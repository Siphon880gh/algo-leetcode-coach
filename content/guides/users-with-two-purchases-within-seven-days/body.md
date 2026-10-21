A table Purchases records purchase_id, user_id and purchase_date. Return the ids of users who made two purchases at most 7 days apart, in ascending order. For instance, a user buying on 2022-03-13 and 2022-03-20 qualifies; one buying twice on the same day qualifies; one with a single purchase does not. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Only neighbours matter

Using the column names the statement gives:

1. `gap = DATEDIFF(purchase_date, LAG(purchase_date) OVER (PARTITION BY user_id ORDER BY purchase_date))`.
2. `SELECT DISTINCT user_id WHERE gap ≤ 7 ORDER BY user_id`.

Constructed check (run in SQLite with julianday; users 2 and 7 as in the example above, user 5 with one purchase): 2, 7.

If any two purchases are within 7 days, some pair of consecutive purchases is too, so comparing neighbours is enough.

Time: O(n log n)  
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
