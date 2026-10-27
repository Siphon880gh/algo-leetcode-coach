## Cuts give away the top or the left

1. `A[i][j]` = apples in the sub-grid from `(i, j)` to the bottom-right.
2. `dp(i, j, 1) = 1` if `A[i][j] > 0`, else 0.
3. Horizontal cut at row `x > i`: valid if the top strip has an apple (`A[i][j] − A[x][j] > 0`); add `dp(x, j, c − 1)`. Vertical cuts are the same with columns.
4. Take everything mod 1e9+7.

`["A..","AAA","..."]`, k = 3 → 3. `["A..","AA.","..."]`, k = 3 → 1. `["A..","A..","..."]`, k = 1 → 1.

Do not forget that the remaining piece must also contain an apple. That is the base case.

Time: O(k · R · C · (R + C))  
Space: O(k · R · C)

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
