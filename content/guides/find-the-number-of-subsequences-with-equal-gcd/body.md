## Three choices per element

1. dp[0][0] = 1.
2. For each x: new = dp (skip) + dp moved to (gcd(g1, x), g2) + dp moved to (g1, gcd(g2, x)).
3. Answer Σ dp[g][g] for g ≥ 1, mod 10^9 + 7.

Examples → 10, 2, 50. Checked against every assignment on 200 random arrays.

Letting the two subsequences share indices: example 3 → 225 instead of 50.

Time: O(n · M² · log M), M = 200  
Space: O(M²)

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
