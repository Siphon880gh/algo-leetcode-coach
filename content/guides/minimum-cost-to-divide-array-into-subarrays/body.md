## O(n²) DP

1. P, C = prefix sums of nums and cost; dp[0] = 0.
2. dp[r] = min over 1 ≤ l ≤ r of dp[l − 1] + P[r] · (C[r] − C[l − 1]) + k · (C[n] − C[l − 1]).
3. Answer dp[n].

Examples → 110, 985. Checked against every division on 300 random arrays.

Charging k · 1 per segment (dropping its index): example 1 → 100 instead of 110.

Time: O(n²)  
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
