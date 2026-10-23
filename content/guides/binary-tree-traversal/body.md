## Tiny example

Same tree:

```
      1
     / \
    2   3
   /
  4
```

- **Preorder** (root, left, right): `1, 2, 4, 3`
- **Inorder** (left, root, right): `4, 2, 1, 3`
- **Postorder** (left, right, root): `4, 2, 3, 1`
- **Level-order / BFS**: `1, 2, 3, 4` (queue)

## How

DFS trio: recurse with the visit in a different slot relative to left/right calls.

BFS:

1. Queue ← root
2. While queue not empty: dequeue, visit, enqueue left then right if present

## Trap

Mixing “inorder” with BST sorted order when the tree is **not** a BST — inorder is only sorted for binary **search** trees.

**Fix:** Inorder means left→root→right on any binary tree; the sorted property needs the BST invariant too.

**Time:** O(n) · **Space:** O(h) recursion or O(width) for BFS queue

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
