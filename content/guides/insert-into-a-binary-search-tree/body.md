## Insert as a leaf

If the root is null, the new node is the tree.

Otherwise walk: if `val < node.val`, go left, else go right. When the chosen child is null, attach `TreeNode(val)` there and return the original root.

Recursive form: `insert(node, val)` returns `TreeNode(val)` for null, otherwise sets `node.left = insert(node.left, val)` or `node.right = …` and returns `node`.

Any valid BST is accepted, so inserting as a leaf is always correct; the problem guarantees `val` is not already in the tree.

Do not rebuild or rebalance; it is unnecessary. Do not return the new node instead of the root, except when the tree was empty.

Time: O(h)  
Space: O(1) iterative

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
