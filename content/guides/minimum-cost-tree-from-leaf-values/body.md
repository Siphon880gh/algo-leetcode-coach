## Smallest leaf pairs with its smaller neighbour

Stack starts empty, `cost = 0`. For each `a` in `arr`:

- While the stack is non-empty and `stack[-1] ≤ a`: `mid = pop()`; `cost += mid · min(stack[-1], a)` if the stack is non-empty, else `mid · a`.
- Push `a`.

Then, while the stack has at least two values: `cost += pop() · stack[-1]`.

Return `cost`.

A small leaf should be merged as early as possible with the smaller of its neighbours, because its value stops mattering once it is merged. An interval DP over `dp[i][j] = min(dp[i][k] + dp[k+1][j] + max(i..k) · max(k+1..j))` gives the same answer in O(n³).

Do not merge the two largest leaves first; large values would be paid repeatedly.

Time: O(n)  
Space: O(n)

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
