## Parity-aware Dijkstra

1. If `grid[0][1] > 1` and `grid[1][0] > 1`, return −1.
2. Dijkstra from (0, 0) at time 0. Moving to a neighbour: `t = cur + 1`; if `t < g`, set `t = g + ((g − t) mod 2)`.
3. Return the time popped for the bottom-right cell.

Examples → 7, −1. Checked against a second-by-second simulation on 300 random small grids.

Every move flips the parity of i + j + time, so waiting costs an even number of seconds. Once a first move exists you can always bounce between two cells.

Time: O(m · n log(m · n))  
Space: O(m · n)

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
