## Tiny example

Complete tree stored in an array (heap indexing):

```
index:  0  1  2  3  4
value:  1  2  3  4  5
```

Means:

```
      1
     / \
    2   3
   / \
  4   5
```

For node at index `i` (0-based):

- left child → `2i + 1`
- right child → `2i + 2`
- parent → `(i - 1) // 2` (i > 0)

## When it fits

**Complete** (or nearly complete) trees: heaps. Sparse trees waste holes in the array — pointer nodes may be better.

## Trap

Using `2i` and `2i+1` with 0-based arrays (that formula is the 1-based habit).

**Fix:** Pick 0-based (`2i+1`, `2i+2`) or 1-based (`2i`, `2i+1`) and stay consistent.

**Time:** O(1) parent/child index math · **Space:** O(n) for a complete tree

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
