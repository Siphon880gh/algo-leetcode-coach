A transactions table records, for each transaction, a customer, a date and an amount. Find the stretches of consecutive days on which a customer’s amount rose every day, and report each long enough stretch with its customer and first and last dates. The minimum stretch length, whether a tie breaks a stretch, the columns and the output order are in the official statement. For instance, a customer paying 100, 150 and 200 on three consecutive days, then 120 on the fourth, has one rising stretch covering the first three days. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Label the stretches

Using the column names the statement gives:

1. Over each customer’s rows by date, mark a break unless the previous row is exactly one day earlier and has a smaller amount (`LAG`).
2. A running `SUM` of the breaks gives a stretch number.
3. `GROUP BY` customer and stretch; keep groups long enough, with `MIN` and `MAX` of the date.

Constructed check (run in SQLite): amounts 100, 150, 200, 120 on May 1–4 give May 1–3; 50, 50, 70 give nothing; 10 on May 1, then 20, 30, 40 on May 3–5 give May 3–5.

Both conditions matter: a missing day and an equal amount each end a stretch.

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
