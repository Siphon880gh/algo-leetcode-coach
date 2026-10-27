You have an unlimited supply of coins of a few fixed values and a limited number of coins of one more value. Count the ways to make the sum n, where the same coins in a different order count once. Return the count modulo the value the statement gives. The coin values, the limit and n’s range are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Combinations, then the limited coin

This assumes the limited coin is a separate value with a fixed maximum count c; check the official statement for the values.

1. dp[0] = 1. For each unlimited coin u (outer loop), for s = u … n: dp[s] += dp[s − u].
2. Answer = Σ dp[n − t · v] for t = 0 … c with t · v ≤ n, taken mod the statement’s modulus.

Constructed checks (run in code, with unlimited 1s and 2s and at most one 3): n = 4 → 4; n = 6 → 6. Checked against listing every combination for n < 30 and c ≤ 2.

Treating the limited coin as unlimited gives n = 6 → 7. Looping sums outside coins counts orders.

Time: O(n · number of coin values)  
Space: O(n)

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
