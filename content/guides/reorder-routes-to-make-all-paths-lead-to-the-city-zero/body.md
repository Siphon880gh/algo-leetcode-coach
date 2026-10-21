## Cost-1 for forward edges

1. For `[a, b]`: add `(b, 1)` to `a` and `(a, 0)` to `b`.
2. BFS or DFS from 0; when moving `u → v` along `(v, c)`, add `c`.

n = 6, `[[0,1],[1,3],[2,3],[4,0],[4,5]]` → 3. n = 5, `[[1,0],[1,2],[3,2],[3,4]]` → 2. n = 3, `[[1,0],[2,0]]` → 0.

Do not search from every node to 0. One traversal from 0 suffices because the graph is a tree.

Time: O(n)  
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
