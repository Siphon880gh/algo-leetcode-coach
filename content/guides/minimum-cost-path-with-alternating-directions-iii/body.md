## Dijkstra

1. State (i, j, k), where k = 1 when the next action is odd. Start (0, 0, 1) at cost 1.
2. Wait: (i, j, k) → (i, j, 1 − k), cost penalty[i][j].
3. Move to a neighbour (x, y): cost (x + 1)(y + 1), plus penalty[i][j] when the direction breaks the rule (odd needs right or down, even needs left or up). The next state is (x, y, 1 − k).
4. Return the cost the first time (m − 1, n − 1) is popped, in either parity.

Examples → 8, 7, 12. Checked against Bellman-Ford relaxation on random grids up to 4 × 4.

Never waiting: example 2 → 10 instead of 7.

Time: O(mn log(mn))  
Space: O(mn)

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
