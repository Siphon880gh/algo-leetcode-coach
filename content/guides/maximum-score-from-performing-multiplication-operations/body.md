## State by operations and left picks

1. `dp[i][l]` = best score from operation `i` on, having taken `l` from the left.
2. `dp[i][l] = max(mul[i] · nums[l] + dp[i + 1][l + 1], mul[i] · nums[n − 1 − (i − l)] + dp[i + 1][l])`.
3. `dp[m][·] = 0`; answer `dp[0][0]`. Roll the array over `i`.

`[1,2,3], [3,2,1]` → 14. `[-5,-3,-3,-2,7,1], [-10,-5,3,4,6]` → 102.

Do not index by both pointers; `n` can be 10^5, so an n × n table is impossible. Greedy choice of the larger product fails with negatives.

Time: O(m²)  
Space: O(m)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
