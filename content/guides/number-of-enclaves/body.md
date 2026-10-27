## Erase what can escape

1. For every cell on the outer edge that is 1, flood fill (DFS or BFS) through 4-neighbours and set each visited cell to 0.
2. Count the cells still equal to 1.

Use an explicit stack or BFS queue; grids can be 500 × 500, deep enough to overflow recursion.

Do not search from every interior cell to see whether it reaches the border; that repeats work. Do not count diagonal connections; moves are 4-directional.

Time: O(m · n)  
Space: O(m · n) in the worst case for the queue

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
