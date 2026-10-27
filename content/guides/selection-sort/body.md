## Tiny example

Sort `[3, 1, 4, 2]`.

Pass 0 fills position 0:

1. Scan the whole range. The minimum is `1`, at index 1.
2. Swap it with index 0, giving `[1, 3, 4, 2]`.

Pass 1 fills position 1. The minimum of the rest is `2`, so swap it into place, giving `[1, 2, 4, 3]`.

Continue until the array is `[1, 2, 3, 4]`.

## How

1. For each `i` from `0` to `n-2`:
2. Find the index of the minimum in `a[i … n-1]`.
3. Swap it with `a[i]`.

## Trap

Confusing selection sort with insertion sort. Selection sort **finds the minimum and swaps once**. Insertion sort **slides** the next element left into a sorted prefix.

**Fix:** State the invariant: after `i` passes, `a[0 … i-1]` holds the `i` smallest items, in sorted order.

**Time:** O(n²) always · **Space:** O(1)

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
