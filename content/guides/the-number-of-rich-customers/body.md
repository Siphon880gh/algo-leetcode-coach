A table of bills lists a bill id, a customer id and an amount. A customer is rich if at least one of their bills has an amount above a threshold the statement gives. Report the number of rich customers. For instance, with a sample threshold of 500 and bills of 549 and 834 for customer 1, 394 for customer 2, and 657 and 257 for customer 3, the answer is 2. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## COUNT(DISTINCT …)

Using the column names the statement gives: take the threshold and output name from it too.

`SELECT COUNT(DISTINCT customer_id) FROM Store WHERE amount > threshold`.

Constructed check (run in SQLite, the example above): 2.

`DISTINCT` matters because customer 1 has two qualifying bills but counts once.

Time: O(n)  
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
