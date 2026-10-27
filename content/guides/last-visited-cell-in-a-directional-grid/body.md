## Example first

grid = [["R", "D"], ["U", "L"]].

1. (0, 0) says R: go to (0, 1).
2. (0, 1) says D: go to (1, 1).
3. (1, 1) says L: go to (1, 0).
4. (1, 0) says U, which points at (0, 0). It is already visited, so the move is not made.

Answer [1, 0].

## Steps

1. Keep a visited grid. Start at (0, 0) and mark it.
2. Read the arrow and compute the next cell.
3. If it is off the grid or already visited, return the current cell.
4. Otherwise move there, mark it, and repeat.

Each cell is entered at most once, so the walk ends within m · n steps.

## Trap

Returning the blocked target. Example 1 then gives [0, 0] instead of [1, 0]. Fix: the blocked move is not made, so report the cell you are on.

Checked: both examples match.

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
