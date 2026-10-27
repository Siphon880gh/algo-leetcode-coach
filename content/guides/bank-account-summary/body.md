A users table gives each user's starting credit, and a transactions table records transfers (payer, payee, amount). Report each user's final credit and whether it went below zero, with labels as the statement specifies. For instance, credit 100 that pays 150 and receives 20 ends at −30 and is flagged. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Signed ledger

Using the column names the statement gives:

1. `SELECT paid_by AS id, −amount AS delta UNION ALL SELECT paid_to, amount`.
2. `Users LEFT JOIN (SUM(delta) per id)`; `credit + COALESCE(net, 0)` as the final credit.
3. `CASE WHEN final < 0 THEN <yes label> ELSE <no label> END`.

Do not inner join; users without transactions must still appear. Do not use UNION (it drops equal rows).

Time: O(rows)  
Space: O(users)

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
