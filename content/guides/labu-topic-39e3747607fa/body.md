## Tiny example

Learn binary trees in this order, practicing on a small tree with root `1` and children `2` and `3`:

1. **Traverse.** Walk the tree in the DFS orders (preorder, inorder, postorder) and level by level with BFS.
2. **Recurse.** Compute answers such as height, or the pieces of a diameter, by combining the results from the left and right children.
3. **Specialize.** Study the rules of binary search trees and the shape of heaps.

Do not jump to AVL rotations before you can traverse a tree confidently.

## How

1. Master the walk orders.
2. Write divide and conquer on the left and right subtrees.
3. Then study the rules for binary search trees and heaps.

## Trap

Memorizing binary search tree insertion before you know inorder and preorder traversal.

**Fix:** Get fluent with traversals first.

**Time:** each walk is O(n)

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
