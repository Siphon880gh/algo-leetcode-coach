## Reduce to subset sum by size

If part A has size `k` and the same average as the whole array, its sum is `total · k / n`. So:

1. Keep only sizes `k` in `1 … n // 2` (the smaller part suffices) with `total · k % n == 0`. If none exist, return false.
2. `sums[k]` = the set of sums reachable with exactly `k` elements. For each number `x`, for `k` from high to low: `sums[k + 1] |= {s + x for s in sums[k]}`.
3. Return true if some valid `k` has `total · k / n` in `sums[k]`.

Bitsets (an integer per size, shifted by `x`) make step 2 fast.

**Meet in the middle:** shift values to `x · n − total` so the target becomes "a non-empty proper subset summing to 0", then combine sums from the two halves.

Do not try all 2³⁰ subsets. Do not forget the integer check; most sizes are ruled out by it.

Time: O(n² · total) with sets, much faster with bitsets  
Space: O(n · total)

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
