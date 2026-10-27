## Count the subarrays ending at right

If `k ≤ 1`, return 0: every product of positive integers is at least 1.

Keep `prod = 1` and `left = 0`. For each `right`:

1. `prod *= nums[right]`.
2. While `prod ≥ k`: `prod /= nums[left]`, `left += 1`.
3. Add `right − left + 1`: every subarray ending at `right` that starts in `[left, right]` has product below `k`.

Positivity is what makes shrinking safe: removing an element never increases the product.

Do not enumerate all subarrays; that is O(n²). Do not skip the `k ≤ 1` guard; the while loop would empty the window and then try to divide past it.

Time: O(n)  
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
