## Tiny example

The array is `[5, 1, 9, 3, 7, 8]`, and you need the `k = 3` largest values, which are `{9, 8, 7}`.

Keep a **min-heap of size k**:

1. Push values until the heap holds k of them.
2. For each new `x`, if `x` is larger than the heap's top, pop the top and push `x`.
3. At the end, the heap holds the k largest values, and its top is the **smallest of them**.

## How

1. Choose between a size-k heap, a full sort and quickselect.
2. For the heap approach, keep it at size k, using the opposite order to what you want (a min-heap for the largest values).
3. Output the heap's contents at the end.

## Trap

Building a max-heap of all n values and popping k times without thinking. That is fine for small n, but a size-k min-heap uses less memory and runs in O(n log k).

**Fix:** Prefer a size-k heap when k is much smaller than n. Use quickselect when you only need the k-th value as a threshold.

**Time (size-k heap):** O(n log k) · **Space:** O(k)

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
