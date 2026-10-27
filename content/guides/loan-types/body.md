A table lists loans, each with a user and a loan type. Report the users who have at least one loan of each of two loan types named in the statement. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Conditional counts

Using the column names the statement gives:

1. `GROUP BY user HAVING SUM(loan_type = 'X') > 0 AND SUM(loan_type = 'Y') > 0`, with X and Y the two types the statement names, ordered as it asks.

Constructed check (run in SQLite): user 1 has X and Y, user 2 has X twice, user 3 has Y and Z, user 4 has Y, X and Z → users 1 and 4.

`WHERE loan_type IN ('X', 'Y')` alone keeps anyone with either type: users 1, 2, 3 and 4.

Time: O(n)  
Space: O(number of users)

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
