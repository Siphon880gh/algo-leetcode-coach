## Validate a window

For each top-left `(r, c)`:

1. Quick filter: the center `grid[r + 1][c + 1]` must be 5.
2. The nine values must be exactly `{1, …, 9}` (distinct, in range).
3. The three rows, three columns, and two diagonals must each sum to 15.

Count the windows that pass.

Why 5: the four lines through the center add up to `4 · 15 = 60`, which counts the center four times and every other cell once, so `3 · center + 45 = 60`.

Do not skip the distinct-digits check; a window of all 5s has every sum equal to 15. Do not allow 0 or values above 9.

Time: O(m · n)  
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
