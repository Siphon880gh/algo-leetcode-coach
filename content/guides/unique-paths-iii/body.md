## Hamiltonian paths on a tiny grid

1. Count `todo` = squares that are not `−1` (start, end and empty). Find the start.
2. `dfs(r, c, left)`:
   - If out of bounds or the cell is `−1` (or already visited), return 0.
   - If it is the end: return 1 if `left == 1` (this is the last square) else 0.
   - Mark the cell `−1`, sum `dfs` over the four neighbors with `left − 1`, restore the cell, return the sum.
3. Return `dfs(start, todo)`.

The grid has at most 20 cells, so full backtracking is fast.

A bitmask DP over (cell, visited set) also works, but backtracking is simpler at this size.

Do not stop at the end square early when cells remain; that path does not count. Do not forget to restore cells after the recursive calls.

Time: O(3^cells) worst case  
Space: O(cells)

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
