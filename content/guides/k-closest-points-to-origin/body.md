## Squared distances, no roots needed

`d(p) = x² + y²` orders points the same way as the real distance.

**Heap:** for each point, push `(−d, point)` onto a heap; if its size exceeds `k`, pop (the farthest). Return the points in the heap.

**Quickselect:** partition by `d` around a pivot until the first `k` positions hold the `k` smallest. O(n) on average, O(n²) worst case with bad pivots (use random pivots).

**Sort:** sort by `d` and take the first `k`; simplest, O(n log n).

Do not take square roots; they cost time and add rounding. Do not use a min-heap of all n points unless you are fine with O(n) memory and O(n + k log n) time.

Time: O(n log k) with the heap  
Space: O(k)

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
