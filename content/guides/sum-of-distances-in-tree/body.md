## Two passes

**Pass 1 (postorder from node 0):** `size[u] = 1 + Σ size[child]`, and `down[u] = Σ (down[child] + size[child])`, the sum of distances from `u` to the nodes in its subtree. Then `ans[0] = down[0]`.

**Pass 2 (preorder):** for each child `v` of `u`,

`ans[v] = ans[u] − size[v] + (n − size[v])`.

Moving the root from `u` to `v` brings the `size[v]` nodes in `v`'s subtree one step closer and pushes the other `n − size[v]` nodes one step farther.

Use an iterative DFS (or raise the recursion limit) for `n` up to 3 · 10⁴.

Do not run a BFS from every node; that is O(n²). Do not mix up which side of the edge gains and which loses.

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
