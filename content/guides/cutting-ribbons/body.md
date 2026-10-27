Given ribbon lengths and an integer k, cut the ribbons into pieces so that at least k pieces share the same positive integer length x (leftover pieces may be discarded, as the statement allows). Return the largest such x, or 0 if no positive length works. For instance, [9,7,5] with k = 3 → 5, [7,5,9] with k = 4 → 4, and [5,7,9] with k = 22 → 0. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Largest feasible length

1. `lo = 0`, `hi = max(ribbons)`.
2. While `lo < hi`: `mid = (lo + hi + 1) // 2`; if `Σ ⌊r / mid⌋ ≥ k`, `lo = mid`, else `hi = mid − 1`.
3. Return `lo`.

Constructed checks (verified against a linear scan over all lengths): the three cases above → 5, 4, 0.

Round `mid` up so `lo = mid` always makes progress. Starting `lo` at 0 covers the impossible case without a special check. Sum in 64-bit if counts can be large.

Time: O(n log max)  
Space: O(1)

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
