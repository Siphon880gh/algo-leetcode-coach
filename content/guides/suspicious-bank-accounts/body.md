An accounts table gives each account's maximum allowed monthly income; a transactions table lists transactions with an account, a type (incoming or outgoing, as the statement names them), an amount and a date. An account is suspicious if its total incoming amount exceeds its maximum in at least two consecutive calendar months. Report those accounts with the column name the statement specifies. For instance, with a limit of 100, totals of 150 in June and 120 in July flag the account, while 150 in June, 50 in July and 130 in August do not. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Monthly totals, then adjacency

Using the column names the statement gives:

1. `m` = per account and month index (`year · 12 + month`): incoming `SUM(amount)`, kept when it exceeds the account's limit.
2. `m x JOIN m y ON y.account = x.account AND y.month = x.month + 1`.
3. `SELECT DISTINCT` the account.

Constructed check (run in SQLite): the two cases above, plus an account over the limit in November and December → the first and third are reported.

Use a month index (or `PERIOD_DIFF`) so December → January counts as consecutive. Filter to incoming transactions before summing.

Time: O(transactions)  
Space: O(account-months)

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
