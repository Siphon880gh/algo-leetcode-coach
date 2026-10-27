## Prefix DP

1. dp[c] = ways for the prefix to have c inversions; start dp[0] = 1 at i = 0.
2. At i: new[c + a] += dp[c] for a = 0 … i, capped at 400.
3. If a requirement ends at i, keep only new[cnt]. Answer: sum of dp after i = n − 1, mod 10^9 + 7.

Examples → 2, 1, 1. Checked against every permutation for n ≤ 6 on 150 random cases.

Checking only the last requirement: example 2 → 2 instead of 1. About 300 · 400 · 300 = 3.6 · 10^7 steps; a prefix sum over a cuts it to 300 · 400.

Time: O(n · 400 · n), or O(n · 400) with prefix sums  
Space: O(400)

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
