## Window max of dp

1. For each `i`: pop front indices `< i − k`.
2. `dp[i] = nums[i] + max(0, dp[front])`.
3. Pop back while `dp[back] ≤ dp[i]`; push `i`.
4. Return `max(dp)`.

`[10,2,-10,5,20]`, k = 2 → 37. `[-1,-2,-3]`, k = 1 → −1. `[10,-2,-10,-5,20]`, k = 2 → 23.

Do not scan the last k dp values for each i; that is O(n · k). Do not force the subsequence to be empty-able; at least one element is taken, so all-negative input returns the largest element.

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
