## Exponent DP

1. Factor k into (a, b, c); if anything is left over, return 0.
2. dp = {(0, 0, 0): 1}.
3. For each x with exponents e: each state goes to itself (leave), + e (multiply) and − e (divide).
4. Return dp[(a, b, c)].

Examples → 2, 2, 3. Checked against all 3^n choices on 400 random cases.

Leaving out division: example 2 → 0 instead of 2.

Time: O(n · S), S ≤ (4n + 1)(2n + 1)² states  
Space: O(S)

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
