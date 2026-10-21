A problems table records each problem's id with its number of likes and dislikes. Report the ids of problems whose like percentage (likes divided by likes plus dislikes) is below the threshold the statement gives, in the order it asks for. For instance, with a sample threshold of 60%, a problem with 1290 likes and 425 dislikes (75%) is fine, while one with 2677 likes and 8659 dislikes (24%) is low-quality. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## One filter

Using the column names the statement gives:

Using the column names the statement gives, with `t` its threshold as a fraction:

`SELECT id FROM problems WHERE likes / (likes + dislikes) < t ORDER BY id`.

Constructed check (run in SQLite with six problems and a sample threshold of 0.6): 7, 10, 11, 13.

Integer division would turn every ratio into 0 or 1 in some engines; multiply by `1.0` first, or compare `likes < t · (likes + dislikes)` instead.

Time: O(n log n)  
Space: O(1)

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
