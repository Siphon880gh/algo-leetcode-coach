## Keep or match

1. dp = [0, −∞, …]; for each i with t = 1 if i is a target:
2. For j = m … 1: dp[j] = max(dp[j] + t, dp[j − 1] if source[i] = pattern[j − 1]); then dp[0] += t.
3. Answer dp[m].

Examples → 1, 2, 0, 2. Checked against every removal set on 300 random cases.

Removing every target not used by the leftmost match: example 4 → 1 instead of 2.

Time: O(n · m), at most 9 · 10^6  
Space: O(m)

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
