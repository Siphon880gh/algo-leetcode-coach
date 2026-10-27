## Tiny example

Sort `[3, 1, 4, 2]` in ascending order with bubble sort.

Pass 1 compares neighbors from left to right:

1. `3` and `1` are out of order, so swap them. The array is `[1, 3, 4, 2]`.
2. `3` and `4` are in order, so leave them.
3. `4` and `2` are out of order, so swap them. The array is `[1, 3, 2, 4]`.

The largest value, `4`, has "bubbled" to the end. Later passes can ignore that last slot because it is already final.

After more passes the array is `[1, 2, 3, 4]`.

## How

1. Run pass `i` for `i` from `0` to `n - 2`.
2. In each pass, scan `j` from `0` to `n - 2 - i`.
3. If `a[j] > a[j + 1]`, swap them.
4. Optionally, stop early when a pass makes no swaps.

## Trap

Assuming every swapping sort is O(n log n).

**Fix:** Bubble sort makes **O(n²)** comparisons and swaps in the average and worst case. With the early-stop check, an already sorted input takes O(n).

**Time:** O(n²) in general · **Space:** O(1)

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
