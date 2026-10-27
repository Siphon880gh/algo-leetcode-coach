## DP

1. f[i][j][0] = 0; f[·][·][t > 0] = −∞ to start.
2. f[i][j][t] = max(f[i − 1][j][t], f[i][j − 1][t], f[i − 1][j − 1][t − 1] + nums1[i − 1] · nums2[j − 1]).
3. Return f[n][m][k].

Examples → 22, 26, −7. Checked against every pair of index sets on 1,500 random cases.

Starting every state at 0: example 3 → 0 instead of −7.

Time: O(n · m · k)  
Space: O(n · m · k), or O(m · k) keeping one row of i

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
