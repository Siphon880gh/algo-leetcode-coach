## Interval DP

1. `c = [0] + sorted(cuts) + [n]`.
2. `dp[i][j] = 0` when `j − i < 2`; else `c[j] − c[i] + min over i < k < j of dp[i][k] + dp[k][j]`.
3. Return `dp[0][m + 1]`.

n = 7, cuts `[1,3,4,5]` → 16. n = 9, cuts `[5,6,1,4,2]` → 22.

Do not index by stick length (n up to 10^6); index by cut positions (≤ 100 cuts). Cutting in input order is not optimal.

Time: O(m³)  
Space: O(m²)

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
