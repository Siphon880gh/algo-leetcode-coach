Every node has `val`, `left`, `right`, and `parent`. You get a `node` but not the root. Return the node with the smallest key greater than `node.val` (its inorder successor), or null. Tree has up to 1e4 nodes with unique values. Tree `[2,1,3]`, node 1 → 2. Tree `[5,3,6,2,4,null,null,1]`, node 6 → null. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Two cases

**Right subtree exists:** the successor is the smallest value there. Go to `node.right`, then follow `left` until it is null.

**No right subtree:** everything below `node` is smaller. Climb: while `node.parent` exists and `node` is `node.parent.right`, move up. Then return `node.parent` — the first ancestor reached from its left side. If you climbed past the root, that is null (the node was the maximum).

Inorder Successor in BST (285) gives the root instead of parents and searches down from it.

Do not compare values to climb — use the pointer test `node == parent.right`. Do not stop at the first parent; a node that is a right child must keep climbing.

Time: O(h)  
Space: O(1)

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
