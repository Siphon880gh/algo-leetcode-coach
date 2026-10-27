## Sort and sweep

1. Sort by (x, −y).
2. For each i: best = −∞; for j > i with y_j ≤ y_i: if y_j > best, count the pair and set best = y_j.

Examples → 0, 2, 2. Checked against testing every rectangle on 1,500 random point sets.

The tie order matters: sorting equal x by y ascending misses [[1, 3], [1, 1]], where (1, 3) is directly above (1, 1) → 0 instead of 1.

Time: O(n²)  
Space: O(1) besides sorting

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
