## Prefix rectangles

1. X[i][j], Y[i][j] = counts of X and Y in rows 0 … i, columns 0 … j (inclusion–exclusion).
2. Count (i, j) with X = Y and X ≥ 1.

Examples → 3, 0, 0.

Dropping the at-least-one-X test counts empty prefixes: example 3 → 4 instead of 0.

Time: O(m n)  
Space: O(m n), or O(n) with one row at a time

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
