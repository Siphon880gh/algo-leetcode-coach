## Parity strategy

Color the piles alternately. Alice moves first, and with an even count she can always take a pile of the color she chooses, forcing Bob onto the other color. The total is odd, so one color has strictly more stones. Return `true`.

## The general DP

`dp[i][j]` = the best (current player − opponent) difference on `piles[i..j]`:

- `dp[i][i] = piles[i]`.
- `dp[i][j] = max(piles[i] − dp[i + 1][j], piles[j] − dp[i][j − 1])`.

Alice wins if `dp[0][n − 1] > 0`. This version also handles odd counts or ties.

Do not simulate a greedy "take the larger end" game; greedy is not optimal in general. Do not store both players' scores separately; the difference is enough.

Time: O(1) with the parity argument, O(n²) with the DP  
Space: O(1), or O(n) for a rolling DP

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
