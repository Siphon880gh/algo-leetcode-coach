## Reverse steps

1. While (x, y) ≠ (sx, sy) and both stay ≥ the start:
   - x > y: x ≥ 2y → x /= 2 (fail if odd); else x −= y.
   - y > x: the same with roles swapped.
   - x = y > 0: branch to (0, y) and (x, 0); (0, 0) is a dead end.
2. Count the steps; −1 if no branch reaches the start.

The largest coordinate at least halves every two steps, so each branch takes O(log max) steps.

Examples → 2, 3, −1. Checked against BFS for every start ≤ 5 and target ≤ 25.

Trying only (0, y) when x = y: (1, 0) → (1, 1) gives −1 instead of 1.

Time: O(log max)  
Space: O(1)

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
