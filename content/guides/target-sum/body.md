## Turn signs into a subset count

Let `total` be the sum and `neg` the sum of the numbers that get a minus. Then the expression equals `(total − neg) − neg = total − 2 · neg`. Setting that equal to `target` gives `neg = (total − target) / 2`. If `total − target` is negative or odd, the answer is 0. Otherwise count the subsets whose sum is `neg`.

Counting 0-1 knapsack: `f[0] = 1`; for each `x`, for `j` from `neg` down to `x`, `f[j] += f[j − x]`. Answer `f[neg]`. Zeros are handled correctly: each 0 doubles the count, since `+0` and `−0` are different expressions.

Brute-force recursion over all `2^n` sign choices is about 1e6 for `n = 20` — it passes, and memo on `(index, sum)` also works. The subset view is faster and cleaner.

Partition Equal Subset Sum (416) asks if a subset reaches half the total. Coin Change II (518) counts with reuse (forward loop).

Do not walk `j` upward (that reuses numbers). Do not forget the parity and sign check. Do not skip zeros.

Time: O(n · neg)  
Space: O(neg)

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
