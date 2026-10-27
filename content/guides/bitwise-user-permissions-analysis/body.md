A table lists users and an integer whose bits are their permissions. Report the permissions every user shares and the permissions any user has, as the statement defines them. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Bitwise aggregates

This assumes the two results are the bitwise AND and the bitwise OR over all rows; check the official statement.

Using the column names the statement gives:

1. `SELECT BIT_AND(permissions), BIT_OR(permissions) FROM user_permissions` (MySQL; name the columns as asked).

Constructed check (run in SQLite with BIT_AND and BIT_OR added as functions): permissions 5, 7, 13 → 5, 15.

SUM instead of BIT_OR: 25 instead of 15.

Time: O(n)  
Space: O(1)

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
