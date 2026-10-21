## Redundant edge = cycle

1. For each cell, for right and down neighbours with the same letter: if `find(a) == find(b)`, return true; else union.
2. Return false.

The ring of `a` around a `bb/bb` block → true. The second example → true. `[["a","b","b"],["b","z","b"],["b","b","a"]]` → false.

Considering only right and down edges visits each undirected edge once. A DFS that ignores the parent cell also works; watch recursion depth on a 500 × 500 grid.

Time: O(mn · α)  
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
