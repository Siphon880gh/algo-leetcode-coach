## Tiny example

```
      4
     / \
    2   6
   / \
  1   3
```

The rule: every key in a node's left subtree is smaller than the node, and every key in its right subtree is larger.

Search for `3`:

1. `3` is less than `4`, so go left.
2. `3` is greater than `2`, so go right.
3. Found `3`.

An inorder walk visits `1, 2, 3, 4, 6`, which is sorted.

## Operations

1. Search and insert follow a single path from the root, so they cost O(h), where h is the height.
2. Delete has a few cases. A node with two children is replaced by its successor or predecessor.
3. A balanced tree has height O(log n). A tree that has become a chain has height O(n).

## Trap

Inserting keys in sorted order into a search tree that never rebalances. The tree turns into a chain, and searches become O(n).

**Fix:** Use a self-balancing tree (AVL, red-black or treap), shuffle the inserts, or stop assuming O(log n) without a balance guarantee.

**Time:** O(h) per operation · **Space:** O(n)

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
