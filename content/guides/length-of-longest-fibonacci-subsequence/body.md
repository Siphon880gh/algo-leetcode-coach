## Two numbers determine the past

The array is strictly increasing. Map each value to its index.

For each `j`, for each `i < j`:

- `x = arr[j] − arr[i]`.
- If `x < arr[i]` and `x` is in the map at index `k`: `dp[i][j] = dp[k][i] + 1`.
- Otherwise `dp[i][j] = 2`.

Track the maximum; return it if it is at least 3, else 0.

`x < arr[i]` keeps the order `k < i < j`.

Do not extend sequences forward by brute force from every pair without memoizing; that repeats work. Do not return 2 when nothing longer exists; the answer is 0.

Time: O(n²)  
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
