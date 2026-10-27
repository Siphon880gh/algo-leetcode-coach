## Forced columns first

1. If `upper + lower ≠ sum(colsum)`, return `[]`.
2. For `colsum[i] == 2`: set both rows to 1, `upper −= 1`, `lower −= 1`.
3. For `colsum[i] == 1`: if `upper > 0`, top row gets 1 and `upper −= 1`; else bottom row and `lower −= 1`.
4. If `upper` or `lower` is negative or not 0 at the end, return `[]`.

`upper = 2, lower = 1, [1,1,1]` → `[[1,1,0],[0,0,1]]`. `upper = 2, lower = 3, [2,2,1,1]` → `[]`.

Do not handle 1-columns before 2-columns; you could spend capacity that a 2-column needs. Any valid matrix is accepted.

Time: O(n)  
Space: O(n) for the output

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
