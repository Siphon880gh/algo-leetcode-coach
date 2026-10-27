## Every cut of every piece

1. `price[h][w]` from the list, 0 if absent.
2. For `h = 1 … m`, `w = 1 … n`: `dp[h][w] = max(price[h][w], max over i ≤ h / 2 of dp[i][w] + dp[h − i][w], max over j ≤ w / 2 of dp[h][j] + dp[h][w − j])`.
3. Return `dp[m][n]`.

Examples → 19, 32.

Cuts go all the way across, so each piece splits into two independent pieces; cuts past the middle repeat earlier ones. Pieces cannot rotate, so h × w and w × h are different states. Totals reach 4 · 10^4 · 10^6, so use 64-bit.

Time: O(m · n · (m + n))  
Space: O(m · n)

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
