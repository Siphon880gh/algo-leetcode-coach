## Lifting

1. DFS from 0: weighted depth D, depth, and up[j][x].
2. a = lca(u, v), total = D[u] + D[v] − 2 · D[a].
3. If 2 · (D[u] − D[a]) ≥ total: lift x from u while 2 · (D[u] − D[x]) < total stays true (never above a); the answer is the parent of where x stops.
4. Else: lift x from v while 2 · (D[u] − 2 · D[a] + D[x]) ≥ total stays true (never above a); the answer is x.

Examples → [0, 1], [1, 0, 2], [2, 2]. Checked against walking each path on 500 random trees.

Comparing with total // 2 instead of total / 2: edges [[0, 1, 8], [1, 2, 9]], query [0, 2] → [1] instead of [2].

Time: O((n + q) log n)  
Space: O(n log n)

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
