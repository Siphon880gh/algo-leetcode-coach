You are given two integer arrays present and future of equal length, where present[i] is what stock i costs today and future[i] is what it will be worth in a year, and an integer budget. You may buy each stock at most once, spending at most budget in total. Return the maximum profit, the sum of future[i] − present[i] over the stocks you buy. For instance, present [4,3,5], future [7,4,9], budget 8 → 5; present [2,6], future [1,5], budget 10 → 0. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Knapsack over spend

1. `dp[0 … budget] = 0`.
2. For each stock with `p = present[i]`, `g = future[i] − p > 0`: for `c = budget … p`: `dp[c] = max(dp[c], dp[c − p] + g)`.
3. Return `dp[budget]`.

Constructed checks (verified against trying every subset on 400 small cases): the cases above → 5, 0; present [3,3], future [5,6], budget 5 → 3.

Going down in `c` uses each stock once. A losing stock never helps, so the answer is never negative: buying nothing gives 0.

Time: O(n · budget)  
Space: O(budget)

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
