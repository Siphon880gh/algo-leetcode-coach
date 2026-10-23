## Subsets

1. pre[v] = mask of nodes with an edge into v.
2. dp[0] = 0; for each mask in increasing order and each v not in mask with pre[v] ⊆ mask: dp[mask | v] = max(…, dp[mask] + score[v] · (popcount(mask) + 1)).
3. Answer dp[all].

Examples → 8, 25. Checked against every valid order on 300 random DAGs.

Always placing the smallest available score next: n = 3, edges [[0, 1]], score = [7, 2, 6] → 26 instead of 29.

Time: O(2^n · n)  
Space: O(2^n)

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
