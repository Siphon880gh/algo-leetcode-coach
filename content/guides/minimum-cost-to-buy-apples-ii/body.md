## Layered Dijkstra

1. Nodes (v, 0) and (v, 1). Edges: road cost on layer 0, cost · tax on layer 1, and (v, 0) → (v, 1) for prices[v].
2. For each i, Dijkstra from (i, 0); stop at (i, 1).

Examples → [6, 3], [8, 4, 6], [5, 11, 1]. Checked against Floyd–Warshall on both costs, trying every shop j, on 800 random graphs.

Returning along the forward route: constructed check (run in code) n = 4, prices = [27, 30, 1, 16], roads = [[0, 1, 5, 1], [0, 2, 3, 4], [1, 2, 2, 2], [1, 3, 1, 2], [2, 3, 3, 2]] → [16, 7, 1, 10] instead of [13, 7, 1, 10].

Time: O(n · (n + m) log n)  
Space: O(n + m)

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
