## Row by row, mask of covered columns

1. `minCol[j] = min_i cost[i][j]`.
2. `f(i, mask)`: if `i == size1`, return `Σ minCol[j]` over `j` not in `mask`.
3. Otherwise `min_j cost[i][j] + f(i + 1, mask | 1 << j)`.

`[[15,96],[36,2]]` → 17. `[[1,3,5],[4,1,1],[1,5,3]]` → 4. The 5 × 3 example → 10.

Giving each group-1 point exactly one chosen edge is enough: extra edges from it only help to cover group-2 points, and the final step covers those more cheaply. size2 ≤ 12 keeps `2^12` masks. Do not run a min-cost matching; points can share partners.

Time: O(size1 · size2 · 2^size2)  
Space: O(size1 · 2^size2)

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
