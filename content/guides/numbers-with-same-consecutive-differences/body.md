## Each digit fixes at most two next digits

`cur = [1, 2, …, 9]` (no leading zero). Repeat `n − 1` times:

- For each number `v` with last digit `d = v % 10`, for each `e` in `{d − k, d + k}` (a set, so k = 0 gives one choice) with `0 ≤ e ≤ 9`, add `10v + e` to the next list.

Return `cur`.

DFS works the same way, building the number digit by digit.

Do not start with 0; numbers like "07" are not allowed. Do not add `d + k` and `d − k` separately when `k == 0`; that creates duplicates.

Time: O(9 · 2ⁿ⁻¹)  
Space: O(9 · 2ⁿ⁻¹) for the results

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
