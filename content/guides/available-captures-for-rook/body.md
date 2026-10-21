## Stop at the first piece

1. Find `(r, c)` with `board[r][c] == 'R'`.
2. For each direction `(dr, dc)` in the four directions:
   - Step from `(r + dr, c + dc)` while in bounds.
   - `'B'`: stop. `'p'`: count 1 and stop. `'.'`: keep going.
3. Return the count (at most 4).

Do not count every pawn in the rook's row and column; pieces in between block the attack. Do not let the rook jump over a bishop.

Time: O(8 · 4) = O(1) for an 8 × 8 board  
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
