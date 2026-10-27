Three school tables each list students (id and name). Report every triplet with one student from each school such that no two of the three share an id or a name, with the columns the statement specifies. For instance, A = (1, Ann), B = (2, Bob), C = (3, Cid) is valid; changing C to (1, Cid) is not. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Cross join, then filter

Using the column names the statement gives:

1. Cross join the three school tables as `a`, `b`, `c` (or `JOIN … ON` with the inequalities).
2. `WHERE` a.id ≠ b.id, a.id ≠ c.id, b.id ≠ c.id, and the same three tests on names.
3. Select the three names in the order required.

Constructed check: (1, Ann), (2, Bob), (3, Cid) → one row. With C = (1, Cid) → none (id clash with A).

Do not test only adjacent pairs (a–b, b–c); a–c must differ too.

Time: O(|A| · |B| · |C|)  
Space: O(output)

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
