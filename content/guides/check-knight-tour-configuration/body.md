## Position by number

1. If `grid[0][0] ≠ 0`, return false.
2. `pos[grid[r][c]] = (r, c)` for every cell.
3. For `k = 0 … n² − 2`: the row and column differences between `pos[k]` and `pos[k + 1]` must be 1 and 2 in some order.
4. Return true.

Examples → true, false.

The values are distinct and cover 0 … n² − 1, so pos is a full ordering of the cells. The start check matters even when all moves are legal.

Time: O(n²)  
Space: O(n²)

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
