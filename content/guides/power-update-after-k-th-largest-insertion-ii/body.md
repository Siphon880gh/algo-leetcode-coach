You get an integer array nums, an integer p and queries of the form [val, k]. For each query, add val to nums, let x be the k-th largest value now in nums, and replace p with p^x modulo 10^9 + 7. Return the value of p after each query. This is the larger version of the problem. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Offline counts

1. vals = sorted distinct values of nums and every query value.
2. Add nums to the Fenwick tree; size = n.
3. Per query [val, k]: add val, size += 1, x = the (size − k + 1)-th smallest via the tree, p = pow(p, x, 10^9 + 7), record p.

Constructed checks (made-up values, run in code): nums = [3, 1, 2], p = 2, queries = [[4, 1], [1, 3]] → [16, 256]; nums = [5], p = 3, queries = [[2, 2], [7, 1]] → [9, 4782969]. Checked against re-sorting after every insert on 2,000 random cases.

Taking the k-th smallest: the first check → [2, 4] instead of [16, 256].

Time: O((n + q) log (n + q) + q log V)  
Space: O(n + q)

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
