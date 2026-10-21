A table Orders records order_id, product_id, quantity and purchase_date. Return the ids of products that were ordered at least three times in each of two consecutive years, in any order. For instance, a product with three orders in 2020 and three in 2021 qualifies; one with three orders in 2022 and three in 2024 but none in 2023 does not. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Year counts joined to next year

Using the column names the statement gives:

1. `y` = `SELECT product_id, YEAR(purchase_date) AS yr FROM Orders GROUP BY product_id, yr HAVING COUNT(*) >= 3`.
2. `SELECT DISTINCT a.product_id FROM y a JOIN y b ON a.product_id = b.product_id AND b.yr = a.yr + 1`.

Constructed check (run in SQLite with strftime; the two products described above): 1.

Count orders, not quantity: the condition is about how many orders were placed. DISTINCT matters when a product qualifies for several pairs of years.

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
