## Sorted sides

1. Sort. m = ⌊n / 2⌋.
2. ops = Σ_{i ≤ m} max(0, a[i] − k) + Σ_{i ≥ m} max(0, k − a[i]).

Examples → 2, 3, 0. Checked against trying every adjustment on 200 random small arrays.

Use the larger middle for even n: index (n − 1)/2 gives example 3 → 1 instead of 0. The total can reach 2 · 10^5 · 10^9; use 64-bit.

Time: O(n log n)  
Space: O(1) besides sorting

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
