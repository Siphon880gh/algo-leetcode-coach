## DP

1. For i in order, for j < i: if groups differ, lengths match, Hamming distance is 1 and `dp[j] + 1 > dp[i]`, set dp[i] and parent[i] = j.
2. Follow parents back from the best i and reverse.

Example 1 → [bab, dab], which is as long as [bab, cab] and also accepted; example 2 → [a, b, c, d]. Length and validity matched testing every subsequence on 300 random inputs.

n ≤ 1000 and words have at most 10 letters, so about 5 · 10^6 checks.

Time: O(n²·L)  
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
