A boxes table lists apple and orange counts per box and optionally a chest id; a chests table lists apple and orange counts per chest. Report the total apples and oranges across all boxes, including the contents of any chest inside a box, with the column names the statement specifies. For instance, a box with 2 apples, 3 oranges and a chest holding 1 and 1, plus a box with 4 apples and no chest, give 7 apples and 4 oranges. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Add chest contents

Using the column names the statement gives:

1. `FROM` boxes `b LEFT JOIN` chests `c ON b.chest_id = c.chest_id`.
2. `SUM(b.apples + IFNULL(c.apples, 0))`, `SUM(b.oranges + IFNULL(c.oranges, 0))`.

Constructed check: (2, 3, chest (1, 1)) and (4, 0, none) → 7 apples, 4 oranges.

An inner join would drop boxes without a chest. Do not sum the chests table on its own; only chests inside boxes count.

Time: O(rows)  
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
