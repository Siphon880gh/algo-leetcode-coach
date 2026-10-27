## Example first

source = (4, 2), target = (1, 3).

1. Different rows and columns.
2. Row gap 3, column gap 1, so not on a diagonal.
3. Slide along row 4 to (4, 3), then along column 3 to (1, 3). Answer 2.

## Rule

1. Same square: 0.
2. Same row, same column, or |sr − tr| = |sc − tc|: 1.
3. Otherwise: 2. On an empty board the row move to (sr, tc) and then the column move always work.

## Trap

Forgetting diagonals. (8, 1) to (1, 8) is one diagonal move, but a rook-style check gives 2 instead of 1. Fix: also test |sr − tr| = |sc − tc|.

Checked: the rule matched a breadth-first search on the board for 300 random pairs.

Time: O(1)  
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
