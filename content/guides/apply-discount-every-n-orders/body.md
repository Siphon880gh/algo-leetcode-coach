## Counter plus price map

1. Constructor: `price[id] = p`, `count = 0`.
2. `getBill(ids, amounts)`: `count += 1`; `bill = Σ price[id] · amount`.
3. If `count mod n == 0`, `bill = bill · (100 − discount) / 100`.

In the example (n = 3, discount 50), the third bill of 800 would be 1600 before the discount; outputs are `[500,4000,800,4000,4000,7350,2500]`.

Do not search the product list on each bill; use a map. Do not reset the counter wrongly; every n-th call gets the discount.

Time: O(products) setup, O(items) per bill  
Space: O(products)

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
