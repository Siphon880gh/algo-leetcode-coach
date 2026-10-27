Given an integer array `nums` and an integer `k`, return the largest `nums[i] + nums[j]` with `i < j` that is less than `k`, or −1 if no pair qualifies. `nums = [34,23,1,24,75,33,54,8]`, `k = 60` → 58 (34 + 24). `nums = [10,20,30]`, `k = 15` → −1. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Largest sum under the bar

1. Sort `nums`. `lo = 0`, `hi = n − 1`, `best = −1`.
2. While `lo < hi`:
   - `s = nums[lo] + nums[hi]`.
   - If `s < k`: `best = max(best, s)`; `lo += 1`.
   - Else `hi −= 1`.
3. Return `best`.

When `s < k`, every pair `(lo, j)` with `j < hi` is smaller, so `lo` is done. When `s ≥ k`, `hi` cannot pair with anything at or above `lo`.

Values are at most 1000, so a counting array also works in O(n + 1000). Do not accept `s == k`; the sum must be strictly less.

Time: O(n log n)  
Space: O(1) beyond the sort

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
