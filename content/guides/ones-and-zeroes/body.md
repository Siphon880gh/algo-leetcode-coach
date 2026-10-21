## Knapsack with two budgets

Each string is an item. Its cost is `a` zeros and `b` ones; its value is 1. Let `f[j][k]` be the most strings you can take using at most `j` zeros and `k` ones. Start all zeros. For each string, for `j` from `m` down to `a`, for `k` from `n` down to `b`: `f[j][k] = max(f[j][k], f[j − a][k − b] + 1)`. Walking both budgets downward keeps each string to one use, as in 1D 0-1 knapsack. Answer `f[m][n]`.

Partition Equal Subset Sum (416) is 0-1 knapsack with one capacity. Coin Change (322) lets items repeat, so its loop runs forward.

Do not walk `j` or `k` upward (that reuses a string). Do not take strings greedily by length — a short string with many ones can block better choices.

Time: O(L + s · m · n), s = number of strings, L = total characters  
Space: O(m · n)

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
