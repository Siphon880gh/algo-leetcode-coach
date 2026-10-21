## Two count arrays

1. `rows[r]`, `cols[c]` = servers in each row and column.
2. Return the number of cells with a server where `rows[r] > 1` or `cols[c] > 1`.

`[[1,0],[0,1]]` → 0. `[[1,0],[1,1]]` → 3. `[[1,1,0,0],[0,0,1,0],[0,0,1,0],[0,0,0,1]]` → 4.

Do not run a flood fill; servers communicate along a whole row or column, not only through neighbours. Do not count a server twice when both its row and column qualify.

Time: O(m · n)  
Space: O(m + n)

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
