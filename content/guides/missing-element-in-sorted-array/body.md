`nums` is sorted in ascending order with unique values. Return the `k`-th missing number, counting from `nums[0]` upward. `nums = [4,7,9,10]`, `k = 1` → 5. Same `nums`, `k = 3` → 8. `nums = [1,2,4]`, `k = 3` → 6. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Missing count is monotone

`miss(i) = nums[i] − nums[0] − i`.

1. If `k > miss(n − 1)`, return `nums[n − 1] + k − miss(n − 1)`.
2. Find the smallest `i` with `miss(i) ≥ k` (binary search on `[1, n − 1]`).
3. Return `nums[i − 1] + k − miss(i − 1)`.

The answer lies between `nums[i − 1]` and `nums[i]`, and `k − miss(i − 1)` counts how far past `nums[i − 1]` it is.

Do not walk number by number; values can be large. Do not forget case 1, where the answer lies beyond the last element.

Time: O(log n)  
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
