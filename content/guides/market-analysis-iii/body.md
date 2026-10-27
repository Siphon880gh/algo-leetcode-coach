Three tables describe sellers (each with a favorite brand), orders (which seller sold which item) and items (each item’s brand). For each seller, count the distinct items they sold whose brand differs from their favorite brand, and report the seller or sellers with the highest count together with that count. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Count, then filter to the max

Using the column names the statement gives:

1. CTE: join orders with sellers and items, `WHERE item brand <> favorite brand`, `GROUP BY seller`, `COUNT(DISTINCT item)`.
2. Select from the CTE where the count equals `(SELECT MAX(count) FROM cte)`, ordered as the statement asks.

Constructed check (run in SQLite): seller 1 (favorite A) sold items of brands A, B, C and B again; seller 2 (B) sold A and C; seller 3 (C) sold B and A; seller 4 (A) sold A → sellers 1, 2, 3 with 2 each.

COUNT without DISTINCT counts the repeated sale: seller 1 → 3, and only seller 1 would be reported.

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
