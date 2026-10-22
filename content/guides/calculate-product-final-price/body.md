One table lists products with a category and a price; another lists a percentage discount for some categories. Return each product’s price after its category’s discount, keeping the full price when the category has no discount. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Left join, default 0

Using the column names the statement gives:

1. `FROM products p LEFT JOIN discounts d ON d.cat = p.cat`.
2. Select the id, `p.price * (100 - COALESCE(d.pct, 0)) / 100` and the category, in the output order the statement shows.
3. Order as the statement says (here by product id).

Constructed check (run in SQLite): products (1, A, 1000), (2, B, 50), (3, A, 1200), (4, C, 500); discounts A 10, B 20 → 900, 40, 1080, 500.

An inner join drops product 4, whose category has no discount.

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
