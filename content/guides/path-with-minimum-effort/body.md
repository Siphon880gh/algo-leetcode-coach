## Minimax Dijkstra

1. `dist[0][0] = 0`; heap `(0, 0, 0)`.
2. Pop `(d, i, j)`; return `d` at the bottom-right; skip if stale.
3. For each neighbour: `nd = max(d, |h[a][b] − h[i][j]|)`; relax if smaller.

`[[1,2,2],[3,8,2],[5,3,5]]` → 2. `[[1,2,3],[3,8,4],[5,3,5]]` → 1. The 5 × 5 maze → 0.

Max is monotone along a path, so Dijkstra stays correct. Do not sum the differences.

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
