`nums` has `n` values (up to `10⁴`) between −10⁴ and 10⁴, and `1 ≤ k ≤ n`. Find the largest average of any contiguous subarray whose length is at least `k`. An answer within `10⁻⁵` is accepted. `[1,12,-5,-6,50,3]`, `k = 4` → 12.75 (`[12,-5,-6,50]`). _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Check a guess in linear time

The answer lies between `min(nums)` and `max(nums)`. Binary search on it with real numbers until `hi − lo < 1e−5`.

**check(m):** is there a subarray of length ≥ `k` with average ≥ `m`?

1. Let `p[i]` be the prefix sum of `nums[j] − m`.
2. For each `i ≥ k`, keep `best = min(p[0..i − k])`. If `p[i] − best ≥ 0`, return true.

Shifting by `m` turns "average ≥ m" into "sum ≥ 0", and the minimum prefix at least `k` positions back gives the best start for each end.

If `check(mid)` is true, set `lo = mid`; otherwise `hi = mid`.

Do not try every length from `k` to `n`; that is O(n²) windows. Do not let the minimum include prefixes closer than `k` to the end; the subarray would be too short.

Time: O(n · log(range / 1e−5))  
Space: O(1) beyond a running prefix

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
