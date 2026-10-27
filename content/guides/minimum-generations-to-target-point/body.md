## Simulate

1. S = set of initial points; return 0 if the target is in S.
2. For k = 1, 2, …: new = floored midpoints of every pair in S, minus S.
3. new empty → −1. Otherwise S ∪= new; return k if the target is in S.

Examples → 1, 2, 0, −1. On 300 random inputs the process never ran past 5 generations.

Pairing only the newest generation: example 2 → −1 instead of 2.

Time: O(G · P²), P ≤ 343  
Space: O(P)

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
