## Sorted prefix maximum

1. Sort by cost; pm[i] = max capacity among the first i + 1.
2. best = max capacity of a single machine with cost < budget.
3. For each j: k = number of machines before j with cost < budget − cost[j]; if k > 0, best = max(best, cap[j] + pm[k − 1]).
4. Return best.

Examples → 8, 6, 9. Checked against every pair on 3,000 random cases.

Allowing a total equal to budget: example 1 → 9 instead of 8.

Time: O(n log n)  
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
