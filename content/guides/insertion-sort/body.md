## Tiny example

Sort `[3, 1, 4, 2]`.

Start with the sorted prefix `[3]`.

1. Take `1`. Slide it left past `3`. The array is `[1, 3, 4, 2]`.
2. Take `4`. It is already at least `3`, so it stays. The array is `[1, 3, 4, 2]`.
3. Take `2`. Slide it left until it sits between `1` and `3`. The array is `[1, 2, 3, 4]`.

## How

1. Loop `i` from `1` to `n − 1`.
2. Let the key be `a[i]`.
3. While the item before the key is larger, shift that item one slot right.
4. Drop the key into the gap.

## Trap

Expecting O(n log n) on input that is sorted in reverse.

**Fix:** Insertion sort is **O(n²)** in the worst and average case, and **O(n)** on input that is already sorted, because each key stops right away. It is great for tiny or nearly sorted arrays, but it is not a general sort for large n.

**Time:** O(n²) worst case · **Space:** O(1)

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
