A table Matches records each player_id, a match_day and a result (Win, Draw or Lose). For every player, return the length of the longest run of consecutive matches that are all wins, or 0 if they never won. For instance, player 1 with Win, Win, Win, Draw, Win → 3; a player with only losses → 0. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Gaps and islands

Using the column names the statement gives:

1. `g = ROW_NUMBER() OVER (PARTITION BY player_id ORDER BY match_day) − ROW_NUMBER() OVER (PARTITION BY player_id, result ORDER BY match_day)`.
2. `w`: rows with `result = 'Win'`, `COUNT(*)` per `(player_id, g)`.
3. Distinct players `LEFT JOIN w`; `COALESCE(MAX(count), 0)` per player.

Constructed check (run in SQLite; player 1 as above, player 2 two losses, player 3 one win): (1, 3), (2, 0), (3, 1).

A non-win breaks the run because it advances the first number but not the second for wins, changing `g`.

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
