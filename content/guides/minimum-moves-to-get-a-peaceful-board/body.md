n rooks stand on an n × n board. In one move you shift one rook to an adjacent cell. Return the fewest moves so that every row and every column holds exactly one rook. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Two independent matchings

This assumes rooks may pass through or share cells while moving; check the official statement.

1. Sort the row coordinates; add |r_i − i|.
2. Sort the column coordinates; add |c_i − i|.

Constructed checks (run in code): rooks at (0, 0), (1, 0), (1, 1) → 3; (0, 0), (0, 1), (0, 2), (0, 3) → 6. Checked against trying every row and column assignment on 300 random boards.

Counting duplicate rows and columns gives 2 instead of 3 on the first check.

Time: O(n log n)  
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
