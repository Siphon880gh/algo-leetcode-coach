## Median per segment

1. Sort; `cost[i][j] = Σ |h[x] − h[(i+j)/2]|` for x in i..j (incrementally: `cost[i][j] = cost[i+1][j−1] + h[j] − h[i]`).
2. `dp(i, k)` = min over `j ≥ i` of `cost[i][j] + dp(j+1, k−1)`; `dp(n, ·) = 0`.

`[1,4,8,10,20]`, k = 3 → 5. `[2,3,5,12,18]`, k = 2 → 9.

Do not place a mailbox at the mean; the median minimises the sum of absolute distances. Groups must be contiguous in sorted order.

Time: O(n² · k)  
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
