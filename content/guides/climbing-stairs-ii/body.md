## Bottom-up DP

1. dp[0] = 0.
2. For j = 1 … n: dp[j] = min over s in 1 … 3 with j − s ≥ 0 of dp[j − s] + costs[j] + s².
3. Return dp[n].

Examples → 13, 11, 12. Checked against trying every jump sequence on 1,500 random arrays.

Allowing only jumps of 1 or 2, as in the classic problem: example 3 → 16 instead of 12.

Time: O(n)  
Space: O(n), or O(1) keeping the last three values

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
