## Four choices per element

1. Options for x: x; ⌈x/2⌉; x − k if x ≥ k; both = min(⌈x/2⌉ − k if ⌈x/2⌉ ≥ k, ⌈(x − k)/2⌉ if x ≥ k).
2. dp over (halvings ≤ op1, subtractions ≤ op2); answer the minimum.

Examples → 23, 3. Checked against every choice on 300 random cases.

Always halving first when using both: [6], k = 4, op1 = op2 = 1 → 2 instead of 1.

Time: O(n · op1 · op2), at most 10^6  
Space: O(op1 · op2)

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
