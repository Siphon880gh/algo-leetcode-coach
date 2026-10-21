## One grouped query

1. `SELECT sell_date, COUNT(DISTINCT product) AS num_sold`.
2. `GROUP_CONCAT(DISTINCT product ORDER BY product SEPARATOR ',') AS products` (or `STRING_AGG` in other dialects).
3. `GROUP BY sell_date ORDER BY sell_date`.

In the statement's example, 2020-05-30 sold Headphone, Basketball, and T-Shirt, giving 3 and "Basketball,Headphone,T-Shirt".

Do not use `COUNT(product)`; the table may repeat a product on a date. Do not forget to sort inside the concatenation.

Time: O(rows log rows)  
Space: O(rows)

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
