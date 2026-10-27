## Use the BST order

`trim(node)`:

- null → null.
- `node.val < low`: the node and its whole left subtree are too small. Return `trim(node.right)`.
- `node.val > high`: the node and its whole right subtree are too large. Return `trim(node.left)`.
- Otherwise: `node.left = trim(node.left)`, `node.right = trim(node.right)`, return `node`.

The BST property is what lets you drop an entire side at once, and the relative structure of the kept nodes stays the same.

An iterative version first moves the root into the range, then walks down the left spine fixing nodes below `low` and the right spine fixing nodes above `high`.

Do not delete nodes one at a time with the usual BST delete; that rebuilds the tree and is slower. Do not return `null` for an out-of-range node; one of its subtrees may still hold valid nodes.

Time: O(n)  
Space: O(h)

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
