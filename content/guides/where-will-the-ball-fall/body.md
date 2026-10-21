## Per-ball walk

1. For each start column `c`, for each row `r`: `d = grid[r][c]`, `nc = c + d`.
2. If `nc` is out of range or `grid[r][nc] ≠ d`, the ball is stuck → −1.
3. Otherwise `c = nc`. After the last row, record `c`.

Example 1 → `[1,-1,-1,-1,-1]`. `[[-1]]` → `[-1]`. Example 3 → `[0,1,2,3,4,-1]`.

A V shape is exactly `grid[r][c] ≠ grid[r][c + d]`. m, n ≤ 100, so simulating every ball is cheap.

Time: O(m · n)  
Space: O(n)

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
