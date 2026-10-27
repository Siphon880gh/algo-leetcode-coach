## Four sweeps, one minimum

Build the grid as all 1s with the mines set to 0.

`dp[r][c]` starts at `n`. Do four sweeps, each keeping a running count that resets to 0 at a mine:

- Each row left to right and right to left.
- Each column top to bottom and bottom to top.

In every sweep, `dp[r][c] = min(dp[r][c], count)`. After all four, `dp[r][c]` is the plus order centered at `(r, c)`, because each arm can extend only as far as its shortest direction.

Return `max(dp)`; it is 0 when every cell is a mine.

Do not expand each center outward step by step; that is O(n³). Store the mines in a set or the grid for O(1) checks.

Time: O(n²)  
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
