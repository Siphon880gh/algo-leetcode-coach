## The rules as checks

Count `x` and `o`, and test whether each player has a line (8 lines: 3 rows, 3 columns, 2 diagonals).

- `o > x` or `x > o + 1` → false.
- X wins and `x ≠ o + 1` → false: the game would have stopped at X's winning move.
- O wins and `x ≠ o` → false: O's winning move ends the game with equal counts.

Otherwise true. These checks also reject both players winning, because the two count conditions cannot hold at once.

X can win with two lines at once (one move completing both), so do not reject a double line for the same player.

Do not simulate all games; the checks are enough. Do not forget the O-wins case; an extra X move after O wins is invalid.

Time: O(1)  
Space: O(1)

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
