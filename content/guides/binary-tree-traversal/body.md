## Tiny example

The same tree as before:

```
      1
     / \
    2   3
   /
  4
```

- **Preorder** visits the root, then the left subtree, then the right subtree: `1, 2, 4, 3`.
- **Inorder** visits the left subtree, then the root, then the right subtree: `4, 2, 1, 3`.
- **Postorder** visits the left subtree, then the right subtree, then the root: `4, 2, 3, 1`.
- **Level order** (breadth-first) goes row by row using a queue: `1, 2, 3, 4`.

## How

The three depth-first orders use the same recursion. The only difference is where the "visit" line sits compared with the two recursive calls.

Level order:

1. Put the root in a queue.
2. While the queue is not empty, take the front node, visit it, and add its left child and then its right child if they exist.

## Trap

Expecting inorder to come out sorted on a tree that is **not** a binary search tree. Inorder is only sorted for binary **search** trees.

**Fix:** Inorder means left, root, right on any binary tree. The sorted result also needs the search-tree ordering rule.

**Time:** O(n) · **Space:** O(h) for recursion, or O(width) for the level-order queue

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
