## Tiny example

Sort these values, which are spread roughly evenly between 0 and 1: `[0.42, 0.11, 0.75, 0.08]`.

1. Make 4 buckets, one for each quarter of the range.
2. Scatter the values. `0.08` and `0.11` go to bucket 0, `0.42` goes to bucket 1, and `0.75` goes to bucket 2.
3. Sort each bucket. Insertion sort is fine because the buckets are small.
4. Join the buckets in order: `[0.08, 0.11, 0.42, 0.75]`.

## How

1. Choose how many buckets to use and a rule that maps each value to a bucket.
2. Put each element in its bucket.
3. Sort each bucket.
4. Join the buckets in order.

On average this is **O(n)** when the data is spread evenly enough that buckets stay small. In the worst case, everything lands in one bucket, and a quadratic sort inside it makes the whole thing **O(n²)**.

## Trap

Assuming bucket sort is linear no matter how the data is spread.

**Fix:** Say that you are assuming evenly spread data, or sort each bucket with an O(n log n) sort.

**Time:** O(n) on average for evenly spread data · **Space:** O(n + number of buckets)

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
