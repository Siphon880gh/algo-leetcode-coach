## Search

1. bonus[i] from a difference array over the boosts.
2. feasible(v): for each monster, fail if v + bonus[i] < monsters[i]; else v = max(0, v − monsters[i]).
3. Binary search the smallest feasible v in [0, Σ monsters].

Examples → 30, 5. Checked against counting up from 0 on 500 random cases. Edge check: 50,000 monsters of 10^9 and no boosts → 5 · 10^13, so use 64-bit integers.

Taking the largest monsters[i] − bonus[i]: example 1 → 15 instead of 30. The strength drains as you fight.

Time: O((n + b) log Σ)  
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
