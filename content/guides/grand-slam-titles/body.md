A players table gives each player's id and name; a championships table has one row per year with one column per tournament holding that year's winner id. Report each player who won at least one title with their total number of titles, with the column names the statement specifies. For instance, if player 1 won three of the four events in one year and one the next, and player 2 won the rest, both have 4 titles and a player with no wins is left out. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Columns → rows

Using the column names the statement gives:

1. Subquery: `SELECT <first tournament> AS winner FROM championships UNION ALL SELECT <second> … ` for each tournament column.
2. `JOIN` players on the id = winner; `GROUP BY` the player id and name; `COUNT(*)`.

Constructed check (run in SQLite): years with winners (1, 1, 2, 1) and (2, 1, 2, 2) → player 1: 4, player 2: 4; player 3 does not appear.

Use `UNION ALL`, not `UNION`; plain `UNION` removes duplicates and undercounts repeat winners. The inner join drops players without titles. An alternative is `SUM` over `CASE` per column after a cross join.

Time: O(years · tournaments + players)  
Space: O(players)

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
