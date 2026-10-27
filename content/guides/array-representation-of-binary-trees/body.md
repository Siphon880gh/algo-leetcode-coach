## Tiny example

A complete tree stored in an array (the same layout a heap uses):

```
index:  0  1  2  3  4
value:  1  2  3  4  5
```

This array means:

```
      1
     / \
    2   3
   / \
  4   5
```

For the node at index `i` (counting from 0):

- Its left child is at `2i + 1`.
- Its right child is at `2i + 2`.
- Its parent is at `(i - 1) // 2`, for any `i` greater than 0.

## When it fits

This works best for **complete** or nearly complete trees, such as heaps. A sparse tree leaves many empty slots in the array, so pointer-based nodes may be better.

## Trap

Using `2i` and `2i + 1` on an array that starts at index 0. That formula belongs to arrays that start at index 1.

**Fix:** Choose 0-based indexing (`2i + 1`, `2i + 2`) or 1-based indexing (`2i`, `2i + 1`) and stick with it.

**Time:** O(1) to compute a parent or child index · **Space:** O(n) for a complete tree

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
