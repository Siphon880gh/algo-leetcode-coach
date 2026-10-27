## Tiny example

Preorder: `[3, 9, 20, 15, 7]`  
Inorder: `[9, 3, 15, 20, 7]`

1. The first value of the preorder list, `3`, is the root.
2. Find `3` in the inorder list. Everything to its left, `[9]`, is the left subtree. Everything to its right, `[15, 20, 7]`, is the right subtree.
3. Recurse. The left subtree's preorder is `[9]` and the right subtree's preorder is `[20, 15, 7]`, and so on.

When all values are distinct, this rebuilds the one tree that matches both lists.

## How

1. The root is the first value of the current preorder range.
2. Find the root in the inorder range. That tells you how many nodes are in the left subtree and how many are in the right.
3. Recurse on the matching ranges of both lists. Index ranges work as well as slices.

## Trap

Assuming the preorder list alone is enough to rebuild any binary tree.

**Fix:** You also need the inorder list, or another traversal that tells you the sizes of the left and right subtrees.

**Time:** O(n) with a hash map from value to inorder index · **Space:** O(n)

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
