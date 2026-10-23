## Tiny example

```
      4
     / \
    2   6
   / \
  1   3
```

Invariant: every key in the left subtree `<` node; every key on the right `>`.

Search for `3`:

1. `3 < 4` → go left
2. `3 > 2` → go right
3. Found `3`

Inorder walk yields `1, 2, 3, 4, 6` (sorted).

## Ops

1. Search / insert — follow one path; O(h)
2. Delete — careful successor/predecessor cases
3. Balanced height keeps h = O(log n); a skewed chain is h = O(n)

## Trap

Inserting sorted keys into an unbalanced BST without rotations → linked-list shape, O(n) search.

**Fix:** Use AVL/Red-Black/Treap, or shuffle inserts, or do not rely on O(log n) without a balance guarantee.

**Time:** O(h) per op · **Space:** O(n)

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
