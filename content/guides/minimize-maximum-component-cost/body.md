## Kruskal

1. Sort edges by weight; components = n.
2. For each edge, stop once components ≤ k; otherwise union it and, if it joined two components, record its weight.
3. Answer the last recorded weight (0 if none).

Examples → 4, 5. Checked against trying every subset of kept edges on 300 random graphs.

Deleting the k − 1 heaviest edges instead: n = 3, edges [[0, 1, 2], [1, 2, 7], [0, 2, 1]], k = 2 → 2 instead of 1.

Time: O(E log E)  
Space: O(n)

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
