## Grid of compressed cells

1. Collect all `x1, x2` into sorted unique `xs` and all `y1, y2` into `ys`.
2. For each rectangle, mark every cell `(i, j)` with `xs[i] ≥ x1`, `xs[i + 1] ≤ x2`, `ys[j] ≥ y1`, `ys[j + 1] ≤ y2`.
3. Sum `(xs[i + 1] − xs[i]) · (ys[j + 1] − ys[j])` over marked cells, mod 10⁹ + 7.

With `n ≤ 200`, there are at most 400 × 400 cells, and marking costs O(n³) total.

**Sweep line:** events at each `x` (add or remove a y-interval). Between consecutive x-events, the covered y-length times the x-width adds to the area. A segment tree over compressed y with a cover count gives the covered length in O(log n) per event.

Do not mark unit squares; coordinates go up to 10⁹. Take the modulus only at the end, or use 64-bit integers for intermediate areas (they can exceed 2³¹).

Time: O(n³) grid, O(n log n) sweep  
Space: O(n²) grid

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
