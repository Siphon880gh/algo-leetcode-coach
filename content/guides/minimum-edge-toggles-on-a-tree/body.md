## DFS parity

1. dfs(v): odd = (start[v] ≠ target[v]); for each child c: if dfs(c), add the edge (v, c) and flip odd. Return odd.
2. If dfs(root) is odd, return [−1].
3. Return the edges sorted.

Examples → [0], [1, 2, 5], [−1]. Checked against trying every edge subset on 800 random trees.

Toggling an edge only when the child itself mismatches: example 2 → [2, 5] instead of [1, 2, 5].

Time: O(n log n)  
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
