## Both ends must agree

1. Openings: 1 left/right, 2 up/down, 3 left/down, 4 right/down, 5 left/up, 6 right/up.
2. BFS from `(0, 0)`: for each opening `(dx, dy)` of the cell, the neighbour must have the opposite opening `(−dx, −dy)`.
3. Return whether `(m − 1, n − 1)` is visited.

`[[2,4,3],[6,5,2]]` → true. `[[1,2,1],[1,2,1]]` → false. `[[1,1,2]]` → false.

Do not move just because the current cell opens that way; the neighbour must connect back. Do not forget a visited set; streets can form loops.

Time: O(m · n)  
Space: O(m · n)

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
