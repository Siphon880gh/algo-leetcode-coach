## Every path has a highest node

The longest path through a node goes down into its left subtree and down into its right subtree, so its length is `height(left) + height(right)` in edges, where `height(null) = 0` and `height(node) = 1 + max(height(left), height(right))`.

One DFS returns heights and updates `ans = max(ans, l + r)` at every node. The answer is the best over all nodes.

Binary Tree Maximum Path Sum (124) uses the same shape with values instead of edge counts.

Do not compute the diameter only at the root — the longest path can sit inside one subtree. Do not count nodes instead of edges; `[1,2]` is 1, not 2. Do not call a separate height function for every node; that is O(n²).

Time: O(n)  
Space: O(h)

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
