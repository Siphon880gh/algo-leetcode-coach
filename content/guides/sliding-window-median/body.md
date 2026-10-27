`nums` length 1 to 1e5, values across the 32-bit range, `1 <= k <= n`. Return the median of each window of size `k` as it slides right by one. For even `k`, the median is the mean of the two middle values. `[1,3,−1,−3,5,3,6,7]`, `k = 3` → `[1,−1,−1,3,5,6]`.

## Two heaps, deletes done lazily

`small` is a max-heap of the lower half; `large` is a min-heap of the upper half. Keep `small` with `ceil(k/2)` valid values and `large` with `floor(k/2)`. The median is `small.top` (odd `k`) or `(small.top + large.top) / 2` (even `k`).

Heaps cannot delete from the middle. Instead, when a value leaves the window, add it to `delayed[value]` and decrease the size counter of the heap it belongs to (compare with `small.top`). Whenever a heap's top is in `delayed`, pop it and decrement the count. Do that after every add, removal, and rebalance so both tops are always valid.

A sorted container (balanced BST or `SortedList`) is simpler: insert the new value, remove the old one, read the middle. Both are O(n log k).

Find Median from Data Stream (295) only adds values. Sliding Window Maximum (239) uses a monotonic deque.

Do not average with 32-bit overflow — `(a + b) / 2` with values near 2^31 overflows; use 64-bit or floating point. Do not re-sort each window (O(n k log k)).

Time: O(n log k) (amortized with lazy deletion)  
Space: O(k) plus delayed entries

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
