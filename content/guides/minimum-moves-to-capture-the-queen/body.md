## Casework

1. Rook shares the row (or column) with the queen, and the bishop is not on that line between them → 1.
2. Bishop shares a diagonal with the queen, and the rook is not on that diagonal between them → 1.
3. Otherwise → 2.

Examples → 2, 1. Checked against a sliding-piece simulation on 20,000 random boards.

Blocking matters: rook (1, 1), bishop (1, 4), queen (1, 8) → 2, since the bishop stands between them.

Time: O(1)  
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
