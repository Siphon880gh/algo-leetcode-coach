## Cost from cell parity

1. From (i, j) at time t to neighbour v: max(t, moveTime[v]) + ((i + j) mod 2) + 1.
2. Dijkstra; answer dist at the bottom-right room.

Examples → 7, 6, 4. Checked against a search over every wait and step parity on 150 random grids.

Charging 1 second for every move: example 1 → 6 instead of 7. Up to 750 · 750 = 562,500 rooms.

Time: O(nm log(nm))  
Space: O(nm)

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
