In one move you can remove a palindromic subarray from `arr`, and the rest closes up. Return the minimum number of moves to remove everything. For instance, `[1,2]` takes 2 and `[1,3,4,1,5]` takes 3 (remove 4, then 1 3 1, then 5). _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Where does arr[i] leave?

`dp[i][j]` for `i > j` is 0, and `dp[i][i] = 1`. Otherwise the minimum of:

1. `1 + dp[i + 1][j]` (remove `arr[i]` alone).
2. If `arr[i] == arr[i + 1]`: `1 + dp[i + 2][j]`.
3. For `k` in `i + 2..j` with `arr[k] == arr[i]`: `dp[i + 1][k − 1] + dp[k + 1][j]` (the final palindrome inside can be wrapped by `arr[i]` and `arr[k]` at no extra cost).

Return `dp[0][n − 1]`.

Do not remove the longest palindrome first; greedy can be worse. Do not add 1 in case 3; the outer pair joins the last inner move.

Time: O(n³)  
Space: O(n²)

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
