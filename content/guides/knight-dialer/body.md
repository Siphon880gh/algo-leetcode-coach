## A ten-node graph

Knight moves on the keypad:

- 0 → 4, 6; 1 → 6, 8; 2 → 7, 9; 3 → 4, 8; 4 → 0, 3, 9
- 5 → none; 6 → 0, 1, 7; 7 → 2, 6; 8 → 1, 3; 9 → 2, 4

`dp = [1] * 10` (length-1 numbers). Repeat `n − 1` times:

- `new[d] = Σ dp[p]` over the digits `p` that move to `d` (the moves are symmetric, so the same lists work), mod 10⁹ + 7.

Return `sum(dp)` mod 10⁹ + 7.

Note that 5 contributes only when `n == 1`.

Do not run a DFS per starting digit without memoization; it is exponential. Do not forget the modulus at each step.

Time: O(n)  
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
