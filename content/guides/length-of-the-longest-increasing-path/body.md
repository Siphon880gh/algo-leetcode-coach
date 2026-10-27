## Two LIS runs

1. Left: points with x < x_k and y < y_k. Right: x > x_k and y > y_k.
2. Sort by (x, −y) so equal x cannot chain; strict LIS on y with bisect.
3. Return left + right + 1.

Examples → 3, 2. Checked against an O(n²) DP on 300 random point sets.

Sorting ties by y ascending lets equal x chain: [[1, 1], [1, 2], [2, 3]], k = 2 → 3 instead of 2.

Time: O(n log n)  
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
