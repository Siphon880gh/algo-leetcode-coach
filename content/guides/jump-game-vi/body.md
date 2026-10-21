## Sliding window maximum

1. `dp[0] = nums[0]`; deque `[0]`.
2. For `i ≥ 1`: drop the front if `< i − k`; `dp[i] = dp[front] + nums[i]`.
3. Pop back while `dp[back] ≤ dp[i]`; push `i`. Return `dp[n − 1]`.

`[1,-1,-2,4,-7,3]`, 2 → 7. `[10,-5,-2,4,0,3]`, 3 → 17. `[1,-5,-20,4,-1,3,-6,-3]`, 2 → 0.

A max-heap with lazy deletion gives O(n log n). Do not scan k previous values per step (O(n · k)).

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
