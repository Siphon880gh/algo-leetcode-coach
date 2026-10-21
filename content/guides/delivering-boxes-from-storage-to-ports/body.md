## Sliding-window DP

1. `chg[i]` = number of port changes among boxes `0 … i`; `W` = prefix weights.
2. `dp[i] = min over valid j of dp[j] + 2 + chg[i − 1] − chg[j]`, valid when `i − j ≤ maxBoxes` and `W[i] − W[j] ≤ maxWeight`.
3. The term `dp[j] − chg[j]` is minimised with a monotonic deque: pop the front while invalid, push `i` after popping larger back values.

`[[1,1],[2,1],[1,1]]`, 2, 3, 3 → 4. Example 2 → 6. Example 3 → 6. (A brute-force O(n²) DP agrees on random tests.)

Greedily loading as many boxes as possible is not always optimal; the DP handles it. The "+ 2" covers the first leg to a port and the return to storage.

Time: O(n)  
Space: O(n)

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
