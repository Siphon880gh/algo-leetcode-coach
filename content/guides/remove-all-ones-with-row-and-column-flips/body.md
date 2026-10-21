Given an m × n binary matrix grid, one operation flips every value in a chosen row or a chosen column. Return true if some sequence of operations makes every cell 0, otherwise false. For instance, [[0,1,0],[1,0,1],[0,1,0]] → true; [[1,1,0],[0,0,0],[0,0,0]] → false; [[0]] → true. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Compare with the first row

Return true iff each row `r` satisfies `r == grid[0]` or `r == NOT grid[0]`.

Constructed checks (verified against trying every set of row and column flips on small grids): the three cases above → true, false, true.

Flips commute and flipping twice cancels, so a solution is a set of rows and columns. Two rows end equal after column flips only if they started equal or complementary (then a row flip fixes it).

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
