## Keep both extremes

1. `mx[0][0] = mn[0][0] = grid[0][0]`.
2. For other cells, take candidates from top and left: `x · mx`, `x · mn`; `mx = max`, `mn = min`.
3. If `mx[m−1][n−1] < 0` return −1, else return it mod 1e9+7.

Example 1 → −1. `[[1,-2,1],[1,-2,1],[3,-4,1]]` → 8. `[[1,3],[0,-4]]` → 0.

Do not take the modulo during the DP; it breaks comparisons (values fit in 64 bits since |x| ≤ 4 over at most 29 cells).

Time: O(m · n)  
Space: O(m · n)

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
