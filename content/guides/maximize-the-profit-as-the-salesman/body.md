## By end house

1. Group offers by end.
2. `dp[0] = 0`; for e = 0 … n − 1: `dp[e + 1] = max(dp[e], dp[s] + g for each offer (s, e, g))`.
3. Return `dp[n]`.

Examples → 3, 10. Checked against trying every set of non-overlapping offers on 300 random inputs.

Taking the best offer greedily can block two that fit together: [[0, 0, 1], [0, 2, 2], [1, 3, 2]] needs the first and third for 3, while the middle one alone gives 2.

Time: O(n + m)  
Space: O(n + m)

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
