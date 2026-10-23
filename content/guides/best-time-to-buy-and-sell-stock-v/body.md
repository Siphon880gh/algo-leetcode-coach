## States per transaction count

1. free[0] = 0; long[j] = short[j] = −∞.
2. For each price x (from yesterday’s values): long[j] = max(long[j], free[j] − x); short[j] = max(short[j], free[j] + x); free[j + 1] = max(free[j + 1], long[j] + x, short[j] − x).
3. Answer max(free).

Examples → 14, 36. Checked against trying every set of transactions on 300 random cases.

Allowing only normal transactions: example 1 → 8 instead of 14.

Time: O(n · k)  
Space: O(k)

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
