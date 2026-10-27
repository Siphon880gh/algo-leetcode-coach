## Sum over band count

1. S(i, j) = S(i − 1, j − 1) + j · S(i − 1, j).
2. Answer Σ_j S(n, j) · x(x − 1)…(x − j + 1) · y^j mod 10^9 + 7.

Examples → 6, 32, 684. Checked against every assignment for n ≤ 4, x, y ≤ 3.

Scoring empty stages too (x^n · y^x): example 1 → 18 instead of 6.

Time: O(n · min(n, x))  
Space: O(n²)

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
