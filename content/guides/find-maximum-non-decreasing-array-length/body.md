## DP with a monotonic queue

1. pre = prefix sums; dp[0] = 0, last[0] = 0; a deque holds candidate j with increasing `pre[j] + last[j]`.
2. For i = 1 … n: pop the front while the next candidate still has `pre[j] + last[j] ≤ pre[i]`; take j = front.
3. `dp[i] = dp[j] + 1`, `last[i] = pre[i] − pre[j]`; pop back entries with key ≥ `pre[i] + last[i]`, push i.
4. Return dp[n].

Examples → 1, 4, 3. Checked against trying every split on 1,500 random arrays.

Closing a segment as soon as its sum reaches the previous one is not optimal: [5, 2, 9, 9] → 2 instead of 3 ([5, 2], [9], [9]).

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
