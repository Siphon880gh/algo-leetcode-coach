## Knapsack

1. cnt_i = #{j : factor_i divides factor_j}.
2. f[b] = best 0/1 knapsack value with budget b, weights price_i, values cnt_i.
3. Return max over b of f[b] + (budget − b) // min price.

Examples → 4, 10. Checked against trying every purchase on 300 random cases.

Ignoring free copies: example 2 → 8 instead of 10.

Time: O(n² + n · budget)  
Space: O(budget)

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
