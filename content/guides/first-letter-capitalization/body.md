One table holds text values. Return each text alongside a version where every word starts with an uppercase letter and the rest of the word is lowercase, keeping the spaces as they are. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Character walk

This assumes words are separated by spaces and contain only letters; take the exact rules from the official statement.

Using the column names the statement gives:

1. Recursive CTE over (id, i, text, out), starting at i = 1 with out = ''.
2. Append `upper(substr(text, i, 1))` if i = 1 or `substr(text, i - 1, 1) = ' '`, else `lower(substr(text, i, 1))`.
3. Keep the row with i = length(text) + 1. SQLite joins strings with ||; MySQL uses CONCAT.

Constructed check (run in SQLite): hello wORLD of sql → Hello World Of Sql; DATA␣␣science (two spaces) → Data␣␣Science.

Capitalizing only the first character of the text: hello wORLD of sql → Hello world of sql.

Time: O(total length)  
Space: O(total length)

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
