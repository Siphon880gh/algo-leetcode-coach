## State is the set of used numbers

The running total is the sum of the used numbers, so the bitmask `used` alone describes the position. `win(used)`: for each unused `i`, if `total(used) + i >= desiredTotal`, or `win(used | bit i)` is false (the opponent loses from there), the current player wins. If no move works, they lose. Memoize on the mask — at most 2^20 ≈ 1e6 states, each trying up to 20 moves.

Quick exits first: if `desiredTotal <= 0`, the first player wins without moving. If `1 + 2 + … + max < desiredTotal`, no one can ever reach it, and the first player cannot win — return false.

Nim Game (292) and Stone Game (877) are other two-player games; Predict the Winner (486) uses an interval DP on a score difference.

Do not memoize on the total alone — two different used sets can share a total. Do not recompute the total from scratch inside a hot loop if you can pass it along. Do not skip the "sum is too small" check, or the search treats a draw as a loss for the wrong player.

Time: O(2^m × m), m = maxChoosableInteger  
Space: O(2^m)

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
