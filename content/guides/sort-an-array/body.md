## Merge sort

`sort(lo, hi)` on `nums[lo..hi)`:

1. If `hi − lo ≤ 1`, return.
2. `mid = (lo + hi) // 2`; sort both halves.
3. Merge: two pointers into the halves, always taking the smaller head (take from the left on ties for stability), into a buffer; copy back.

One shared buffer of size `n` avoids allocating in every call.

## Alternatives

- **Heap sort:** O(n log n), O(1) extra space, not stable.
- **Counting sort:** count each value in `[−5·10⁴, 5·10⁴]` with an offset, then write them out. O(n + range).

Do not use plain quicksort with a fixed pivot; sorted or all-equal inputs make it O(n²). If you use quicksort, pick a random pivot and use a three-way partition.

Time: O(n log n)  
Space: O(n)

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
