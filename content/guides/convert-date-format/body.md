A table holds dates. Return each date as text in the format the statement specifies: full weekday name, full month name, day of month without a leading zero, and four-digit year, as in "Tuesday, April 12, 2022". For instance, 2021-08-09 → "Monday, August 9, 2021". _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## One function call

Using the column names the statement gives:

`SELECT DATE_FORMAT(<date column>, '%W, %M %e, %Y') AS <output column> FROM <table>`.

Constructed check (the format reproduced with Python's date names): 2022-04-12 → `Tuesday, April 12, 2022`; 2021-08-09 → `Monday, August 9, 2021`; 2020-06-26 → `Friday, June 26, 2020`.

`%e` is the unpadded day; `%d` would give `09`. `%W` and `%M` are full names, while `%a` and `%b` would be abbreviations.

Time: O(rows)  
Space: O(1)

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
