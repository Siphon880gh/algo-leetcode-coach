## Corners, not flood fill

1. For each cell `(i, j)` with `land[i][j] == 1`, `land[i−1][j] != 1` and `land[i][j−1] != 1`: it starts a group.
2. Walk `r` down while `land[r+1][j] == 1`, and `c` right while `land[i][c+1] == 1`.
3. Record `[i, j, r, c]`.

Example 1 → `[[0,0,0,0],[1,1,2,2]]`. Example 2 → `[[0,0,1,1]]`. Example 3 → `[]`.

Because each group is a solid rectangle and groups never touch, the top-left test finds each group exactly once, and the two walks give its extent. A BFS flood fill also works but is unnecessary.

Time: O(mn)  
Space: O(1) besides the output

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
