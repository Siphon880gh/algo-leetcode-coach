A table lists users’ transactions, each with an amount spent and a date. Report each user whose third transaction (by date) spent strictly more than each of their first two, with that third transaction’s amount and date. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Window functions

Using the column names the statement gives:

1. `ROW_NUMBER() OVER (PARTITION BY user ORDER BY date)`, plus `LAG(spend, 1)` and `LAG(spend, 2)` over the same window.
2. Keep rows with number 3 and `spend > lag1 AND spend > lag2`, ordered as the statement asks.

This assumes a user’s transactions have distinct dates, so the order is well defined.

Constructed check (run in SQLite): user 1 spends 10, 20, 30, 5; user 2 spends 30, 10, 20; user 3 spends 5, 6, 6; user 4 has only two → user 1 with 30.

Comparing only with the second transaction also reports user 2, whose 20 is below the first 30. User 3’s 6 is not strictly more than 6.

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
