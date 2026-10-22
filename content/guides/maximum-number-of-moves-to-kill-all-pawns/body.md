## Distances, then a game DP

1. BFS on the 50 × 50 board from the knight and each pawn.
2. dp(mask, i) over taken pawns and the current square: take max or min over the next pawn j of dist(i, j) + dp(mask | j, j).

Examples → 4, 8, 3.

Playing greedily (Alice farthest, Bob nearest): example 2 → 6 instead of 8. States: 2^15 · 16, each with 15 moves, about 7.9 · 10^6.

Time: O(16 · 2500 + 2^n · n²)  
Space: O(2^n · n)

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
