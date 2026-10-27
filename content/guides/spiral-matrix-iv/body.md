## Turn when blocked

1. `g` = m × n of −1; `(i, j) = (0, 0)`, direction right.
2. For each list value: write it at `(i, j)`; if the next cell in the current direction is outside or already written, turn clockwise; step.
3. Return `g`.

Examples → [[3,0,2,6,8],[5,0,-1,-1,1],[5,2,4,9,7]], [[0,1,2,-1]].

Mark written cells separately or use boundary counters if values could equal −1; here values are ≥ 0, so −1 itself means unwritten. The list has at most m · n nodes, so the walk never runs out of cells.

Time: O(m · n)  
Space: O(1) beyond the output

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
