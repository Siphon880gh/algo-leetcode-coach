You get an integer array nums, an integer p and queries of the form [val, k]. For each query, add val to nums, let x be the k-th largest value now in nums, and replace p with p^x modulo 10^9 + 7. Return the value of p after each query. This is the smaller version of the problem. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Sorted insert

1. a = sorted(nums).
2. Per query [val, k]: insert val by binary search, x = a[len(a) − k], p = pow(p, x, 10^9 + 7), record p.

Constructed checks (made-up values, run in code): nums = [4, 2], p = 3, queries = [[1, 2], [5, 1]] → [9, 59049]; nums = [6, 1, 6], p = 2, queries = [[3, 4], [9, 2]] → [2, 64].

Taking the k-th smallest: the first check → [9, 9] instead of [9, 59049].

Time: O(q · (n + q) + q log V)  
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
