You get chocolate prices and queries, each with a cap k and a count m. For each query, Bob picks m chocolates; for each one he pays the price up to the cap k and Alice pays the rest, and the relative loss compares what Bob pays with what Alice pays. Return the smallest relative loss for each query. The exact payment rule, the loss definition and the limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Split between the ends

This assumes Bob pays min(p, k), Alice pays the rest, and the loss is Bob’s total minus Alice’s, so each chocolate adds p when p ≤ k and 2k − p otherwise. Adapt the per-chocolate cost if the statement defines it differently.

1. Sort prices; prefix sums P.
2. For a query, taking i cheapest and j = m − i most expensive costs `P[i] + 2k · j − (P[n] − P[n − j])`.
3. That cost is convex in i, so binary search the best i (or try all i on small inputs).

Constructed checks (run in code, with that rule): prices [1, 9, 22, 10, 19], k = 18, m = 4 → 34; 400 random small cases match trying every set of m.

Taking the m cheapest ignores that expensive chocolates are cheap for Bob: the same query → 39 instead of 34.

Time: O((n + q) log n)  
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
