## Three-dimensional DP

1. For house `i` and colour `c` (only `houses[i]` if pre-painted): add `cost[i][c]` if unpainted, else 0.
2. From previous colour `p`: `g' = g + (c ≠ p)`; skip when `g' > target`.
3. Answer: `min over c of dp[m−1][c][target]`, or −1 if infinite.

`[0,0,0,0,0]` with the statement's costs, n = 2, target 3 → 9. `[0,2,1,2,0]` → 11. `[3,1,2,3]` with target 3 → −1 (already 4 neighbourhoods).

Do not repaint pre-painted houses. Track the minimum and second-minimum over p to cut a factor of n.

Time: O(m · n² · target)  
Space: O(n · target) rolled

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
