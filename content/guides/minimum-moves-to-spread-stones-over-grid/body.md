## Permutations

1. `ex` = one entry per extra stone; `em` = empty cells.
2. For each permutation of ex, sum the Manhattan distances to em in order; return the minimum.

Examples → 3, 4. Checked against a breadth-first search over grid states on 60 random grids.

Greedy fails: matching each empty cell in row order to its nearest extra stone gives [[0, 2, 0], [2, 0, 3], [0, 1, 1]] → 6 instead of 4. At most 8! orders, so trying them all is fast.

Time: O(8! · 8)  
Space: O(9)

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
