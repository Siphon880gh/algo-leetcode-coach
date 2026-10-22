A table lists property listings, each with a city and a price. Report the cities whose average listing price is higher than the average price over all listings. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## HAVING with a scalar subquery

Using the column names the statement gives:

1. `GROUP BY city HAVING AVG(price) > (SELECT AVG(price) FROM listings)`, ordered as the statement asks.

Constructed check (run in SQLite): A has 100 and 120, B has 300, C has 90, 95, 100 and 105, D has 150 → overall average 132.5, so B and D.

The average of the four city averages is about 164.4, which would drop D.

Time: O(n)  
Space: O(number of cities)

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
