## Tiny example

Max-heap as an array: `[9, 5, 6, 2, 3]`

```
      9
     / \
    5   6
   / \
  2   3
```

Parent ≥ children. Peek max = root `9` in O(1).

Push `10`: add at end, **sift up** swapping with parents until order holds → root becomes `10`.

Pop max: move last to root, **sift down**.

## Ops

| Op | Time |
|----|------|
| peek top | O(1) |
| push / pop | O(log n) |
| build heap | O(n) |

## Trap

Expecting a binary heap to support O(log n) **arbitrary delete by value** without a handle/index map.

**Fix:** Heap gives fast top access. For delete-by-value or change-key, keep an index map (or use a balanced BST / specialized heap).

**Time:** see table · **Space:** O(n)

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
