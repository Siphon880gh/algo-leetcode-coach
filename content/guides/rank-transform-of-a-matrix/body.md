## Value by value

1. Group cells by value; keep `rowMax[i]`, `colMax[j]` (largest rank so far).
2. For one value: DSU on `m + n` nodes; union row `i` with column `j` for each cell.
3. Per component, `rank = 1 + max(rowMax, colMax)` over its cells; assign it, then update `rowMax`, `colMax`.

`[[1,2],[3,4]]` → `[[1,2],[2,3]]`. `[[7,7],[7,7]]` → all 1. Example 3 → `[[4,2,3],[1,3,4],[5,1,6],[1,3,4]]`.

Do not assign equal values independently; linked equal cells must agree. Reset or rebuild the DSU per value.

Time: O(mn log(mn))  
Space: O(mn)

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
