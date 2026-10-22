## Last piece

1. `dp[0] = 0`.
2. For `i = 1 … n`: clear counts; `trim = 0`; for `j = i − 1` down to `0`, add `nums[j]`: its count becomes 2 → `trim += 2`; above 2 → `trim += 1`. Then `dp[i] = min(dp[i], dp[j] + k + trim)`.
3. Return `dp[n]`.

Examples → 8, 6, 10. Checked against trying every split on 300 random arrays.

The second copy brings back the first one too, which is why it adds 2. Values are below n, so an array works for counts.

Time: O(n²)  
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
