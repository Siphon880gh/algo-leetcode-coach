## Contribution of each element

1. For maxima: `L[i]` = distance to the previous element `≥ nums[i]`, `R[i]` = distance to the next element `> nums[i]` (array ends count as walls).
2. `Σ nums[i] · L[i] · R[i]` is the sum of subarray maxima.
3. Repeat with the comparisons flipped for minima; return the difference.

Examples → 4, 4, 59. Checked against every subarray on random arrays.

Using `≥` on one side and `>` on the other assigns each subarray with equal maxima to exactly one index. With n ≤ 1000, an O(n²) double loop tracking the running max and min is also accepted.

Time: O(n)  
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
