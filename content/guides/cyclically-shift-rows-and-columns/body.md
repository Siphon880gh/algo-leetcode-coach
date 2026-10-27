## Example first

grid = [[1, 2], [3, 4]], rowShift = [1, 0], colShift = [0, 1].

1. Row 0 shifts left by 1: [1, 2] becomes [2, 1]. Row 1 stays [3, 4].
2. Scratch grid = [[2, 1], [3, 4]].
3. Column 1 shifts up by 1: [1, 4] becomes [4, 1].
4. Result = [[2, 4], [3, 1]].

## Steps

1. Row pass: t[i][(j − rowShift[i] + n) mod n] = grid[i][j].
2. Column pass on the scratch grid: ans[(i − colShift[j] + n) mod n][j] = t[i][j].
3. Return ans.

Keep the scratch grid. The column shift must see the rows after they moved.

## Trap

Shifting columns first. Example 1 then gives [[4, 1], [3, 2]] instead of [[2, 4], [3, 1]]. Fix: rows first, then columns.

Checked: both examples match.

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
