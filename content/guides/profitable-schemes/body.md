## Cap the profit dimension

`dp[j][k]` = number of schemes using exactly `j` members with profit `min(total, minProfit) = k`. Start with `dp[0][0] = 1`.

For each crime `(g, p)`:

- for `j` from `n` down to `g`, for `k` from `minProfit` down to 0:
  `dp[j][min(minProfit, k + p)] += dp[j − g][k]` (mod 10⁹ + 7).

The answer is the sum of `dp[j][minProfit]` over `j = 0 … n`.

Going down in `j` makes each crime count at most once, because `dp[j − g]` has not been updated for this crime yet.

Capping is the key: profits up to 100 per crime would otherwise make the table huge, and every profit ≥ minProfit qualifies the same way.

Do not enumerate subsets; there are 2¹⁰⁰ of them. Do not forget the modulus.

Time: O(len · n · minProfit)  
Space: O(n · minProfit)

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
