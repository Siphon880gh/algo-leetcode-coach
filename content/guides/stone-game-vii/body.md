## Difference DP

1. Prefix sums `P`.
2. For `i` from `n − 2` down, `j` from `i + 1`: `dp[i][j] = max(P[j + 1] − P[i + 1] − dp[i + 1][j], P[j] − P[i] − dp[i][j − 1])`.
3. Return `dp[0][n − 1]`.

`[5,3,1,4,2]` → 6. `[7,90,5,1,100,10,10,2]` → 122.

Store differences, not both scores; the opponent's best becomes a subtraction. n ≤ 1000 makes O(n²) fine; a 1-D rolling array saves memory.

Time: O(n²)  
Space: O(n²), or O(n) rolling

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
