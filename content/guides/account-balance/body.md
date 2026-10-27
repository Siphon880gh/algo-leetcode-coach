A transactions table records, for each account, a day, a type (Deposit or Withdraw) and an amount. Report each account's balance after every transaction, in the order the statement asks for. For instance, an account depositing 2000, withdrawing 1000 and depositing 3000 on three successive days shows balances 2000, 1000, 4000; another depositing 7000 and then withdrawing 7000 shows 7000, 0. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Signed window sum

Using the column names the statement gives:

`SUM(CASE WHEN type = 'Deposit' THEN amount ELSE −amount END) OVER (PARTITION BY account ORDER BY day)`.

Constructed check (run in SQLite, the example above): 2000, 1000, 4000 and 7000, 0.

Partitioning restarts the sum per account; ordering by day makes it a running balance. If several rows share an account and day, add a tiebreak so the frame does not merge them.

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
