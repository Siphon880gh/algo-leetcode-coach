## Two passes

1. BFS from all thieves at once: `d[r][c]` = distance to the nearest thief.
2. Max-heap from (0, 0) with value d[0][0]; moving to a neighbour gives `min(value, d[neighbour])`.
3. The value when (n − 1, n − 1) is popped is the answer.

Examples → 0, 2, 2. Checked against trying every simple path on 150 random small grids.

A BFS from each thief separately costs O(n²) per thief, up to O(n⁴). The start and end cells count too, so a thief on either one makes the answer 0.

Time: O(n² log n)  
Space: O(n²)

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
