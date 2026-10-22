A table lists pizza toppings, each with a cost. Report every combination of three different toppings with its total cost, rounded and formatted as the statement asks. Table, column and output names, how a combination is written, and the ordering are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Ordered self-join

Using the column names the statement gives:

1. `FROM toppings t1 JOIN toppings t2 ON t1.topping_name < t2.topping_name JOIN toppings t3 ON t2.topping_name < t3.topping_name`.
2. Select the three names in the format the statement asks and `ROUND(t1.cost + t2.cost + t3.cost, 2)`, ordered as asked.

Constructed check (run in SQLite): Pepperoni 0.50, Sausage 0.70, Chicken 0.55, Extra Cheese 0.40 → 4 combinations, the most expensive Chicken, Pepperoni, Sausage at 1.75.

Joining on ≠ instead of < lists each set in every order: 24 rows instead of 4.

Time: O(n³)  
Space: O(n³) output

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
