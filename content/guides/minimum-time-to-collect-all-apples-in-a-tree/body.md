## Post-order cost

1. Build an adjacency list (edges are undirected).
2. `dfs(u, parent)`: for each child `v`, `c = dfs(v, u)`; if `c > 0` or `hasApple[v]`, add `c + 2`.
3. Return `dfs(0, −1)`.

With edges `[[0,1],[0,2],[1,4],[1,5],[2,3],[2,6]]`: apples at 2, 4, 5 → 8; at 2, 5 → 6; none → 0.

Do not assume edges point parent to child; track the parent. Do not add 2 for the root itself.

Time: O(n)  
Space: O(n)

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
