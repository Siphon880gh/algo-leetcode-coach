A rides table records each ride with a bike identifier and the ride’s start and end times. For each bike, find the last time it was used, and order the bikes from most recently used to least. The exact columns and output names are in the official statement. For instance, a bike with rides ending at 10:00 and 15:30 on the same day was last used at 15:30. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Max end time

Using the column names the statement gives:

1. `GROUP BY` the bike; take `MAX` of the end time.
2. `ORDER BY` that value descending.

Constructed check (run in SQLite): three bikes with latest rides ending 2024-05-02 08:40, 2024-05-01 15:30 and 2024-04-30 21:00 come out in that order.

Use the end time, not the start time: a bike is in use until its ride ends. Datetime text in ISO format sorts in time order, so MAX works on it directly.

Time: O(n log n)  
Space: O(number of bikes)

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
