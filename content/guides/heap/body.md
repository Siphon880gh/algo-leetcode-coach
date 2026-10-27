## Tiny example

A max-heap stored as an array: `[9, 5, 6, 2, 3]`

```
      9
     / \
    5   6
   / \
  2   3
```

Every parent is at least as large as its children. Peeking at the maximum means reading the root, `9`, in O(1).

To push `10`, add it at the end and **sift it up**: swap it with its parent while it is larger. Here it rises all the way, and the root becomes `10`.

To pop the maximum, move the last element to the root and **sift it down**: swap it with its larger child until the order holds again.

## Operations

| Operation | Time |
|----|------|
| Peek at the top | O(1) |
| Push or pop | O(log n) |
| Build a heap from n items | O(n) |

## Trap

Expecting a binary heap to delete an arbitrary value in O(log n) without knowing where that value is.

**Fix:** A heap gives fast access to the top. To delete by value or change a key, keep a map from value to index, or use a balanced search tree or a specialized heap.

**Time:** see the table · **Space:** O(n)

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
