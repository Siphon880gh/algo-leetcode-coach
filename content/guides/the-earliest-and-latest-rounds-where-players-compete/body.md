## State = (players left, position of each star)

1. If `i + j == n − 1` (0-indexed), they meet now: `(1, 1)`.
2. Otherwise each other pair (`k`, `n − 1 − k`) picks a winner; the stars and the middle player (odd `n`) always advance; a star's opponent always loses.
3. For each outcome, the new positions are the stars' ranks among the survivors; recurse and add 1.
4. Return min and max over outcomes; memoise.

`n = 11, 2, 4` → `[3, 4]`. `n = 5, 1, 5` → `[1, 1]`.

n ≤ 28 means at most 14 pairs and 2^14 outcomes per state, and few states. Only how many winners fall left of, between and right of the stars matters, which allows a faster count-based DP.

Time: O(states · 2^(n/2) · n) for the brute force  
Space: O(states)

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
