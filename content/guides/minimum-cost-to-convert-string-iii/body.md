## DP

1. dp[0] = 0.
2. source[i] = target[i] → dp[i + 1] = min(dp[i + 1], dp[i]).
3. For each rule of length L: pattern matches source[i … i + L − 1] ('*' matches anything) and replacement = target[i … i + L − 1] → dp[i + L] = min(dp[i + L], dp[i] + cost + count('*')).
4. Return dp[n], or −1.

Examples → 7, 3, 6, −1. Checked against trying every rule placement on 1,500 random cases.

Leaving out the '*' surcharge: example 2 → 2 instead of 3.

Time: O(n · R · L), up to 5000 · 200 · 20 character checks  
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
