## Two parities

1. `best[p]` = −∞ for both; `best[nums[0] mod 2] = nums[0]`.
2. For i ≥ 1 with `p = nums[i] mod 2`: `c = nums[i] + max(best[p], best[1 − p] − x)`; `best[p] = max(best[p], c)`.
3. Return the larger best.

Examples → 13, 20. Checked against trying every visiting set on 400 random arrays.

The parity with no visited value yet must start at −∞, not 0: nums = [2, 3], x = 5 → 3 instead of 2, as if position 0 could be skipped. Scores reach about 10^11, so use 64-bit.

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
