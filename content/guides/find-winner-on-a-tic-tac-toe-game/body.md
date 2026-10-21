## Replay and test

1. Place `A` on even move indices and `B` on odd ones.
2. For each player, test 3 rows, 3 columns, and 2 diagonals.
3. Return the winner if any; else `"Draw"` if there were 9 moves, else `"Pending"`.

A shortcut keeps `+1` for A and `−1` for B in row, column, and diagonal sums; a sum of ±3 is a win.

`[[0,0],[2,0],[1,1],[2,1],[2,2]]` → `"A"`. A full board without a line → `"Draw"`.

Do not return `"Draw"` for fewer than 9 moves; the game is still `"Pending"`. Do not check only the last mover without being sure; testing both is just as cheap.

Time: O(moves)  
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
