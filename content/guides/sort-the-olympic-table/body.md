A table records each country with its numbers of gold, silver and bronze medals. Return the table sorted by gold medals, then silver medals, then bronze medals, each from most to fewest, with any remaining tie broken as the statement specifies. For instance, a country with 2 gold, 2 silver and 3 bronze comes before one with 2 gold, 2 silver and 2 bronze. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Compare medal by medal

Using the column names the statement gives:

`SELECT * FROM Olympic ORDER BY gold DESC, silver DESC, bronze DESC`, followed by the statement’s last tie-break key.

Constructed check (run in SQLite; five countries, two with identical medals): the order follows gold, then silver, then bronze, and the identical pair is settled only by the final key.

A country with more gold ranks higher however many silver or bronze the other has, which is why the keys are listed in order rather than added up.

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
