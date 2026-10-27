A table lists the nodes of a binary tree, each with its parent (empty for the root). Label each node as root, inner or leaf, using the labels the statement gives. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Parent lookups

Using the column names the statement gives:

1. `CASE WHEN P IS NULL THEN <root> WHEN N IN (SELECT P FROM tree WHERE P IS NOT NULL) THEN <inner> ELSE <leaf> END`.

Constructed check (run in SQLite): edges 1→2, 3→2, 6→8, 9→8, 2→5, 8→5, with 5 the root → 1, 3, 6, 9 leaves; 2, 8 inner; 5 root.

Watch NULLs: `N NOT IN (SELECT P FROM tree)` is never true once the list contains the root’s NULL, so in that check every non-root node comes out inner.

Time: O(n)  
Space: O(n)

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
