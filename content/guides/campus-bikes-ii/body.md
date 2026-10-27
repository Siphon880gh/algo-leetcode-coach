On a grid, there are `n` workers and `m` bikes with `1 ≤ n ≤ m ≤ 10`. Give each worker a different bike so that the sum of Manhattan distances between workers and their bikes is as small as possible, and return that sum. `workers = [[0,0],[2,1]]`, `bikes = [[1,2],[3,3]]` → 6. `workers = [[0,0],[1,1],[2,0]]`, `bikes = [[1,0],[2,2],[2,1]]` → 4. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## State = set of used bikes

`dp[mask]` = least total distance after the first `popcount(mask)` workers took the bikes in `mask`. `dp[0] = 0`, the rest infinity.

For each `mask` in increasing order with `i = popcount(mask) < n`: for each bike `j` not in `mask`:

`dp[mask | 1 << j] = min(dp[mask | 1 << j], dp[mask] + dist(i, j))`.

Answer: the minimum `dp[mask]` over masks with `popcount(mask) == n`.

Do not use the greedy order from Campus Bikes; it minimizes each step, not the total. Brute-force permutations are 10!/(10 − n)! cases; the mask DP needs only `2^m · m` steps.

Time: O(2^m · m)  
Space: O(2^m)

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
