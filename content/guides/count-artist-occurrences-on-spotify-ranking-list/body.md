A ranking table lists tracks, each with its artist. Count how many times each artist appears and return each artist with that count, ordered by the count from highest to lowest; the tie-break and output names are in the official statement. For instance, an artist with three listed tracks comes before one with two. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Count per artist

Using the column names the statement gives:

1. `GROUP BY` the artist; `COUNT(*)` the rows.
2. `ORDER BY` the count descending, then the statement’s tie-break.

Constructed check (run in SQLite): artists listed 3, 2 and 1 times → in that order with counts 3, 2, 1.

Each row is one appearance, so COUNT(*) is enough; no join is needed.

Time: O(n log n)  
Space: O(number of artists)

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
