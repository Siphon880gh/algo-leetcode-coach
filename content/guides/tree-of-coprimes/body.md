## 50 stacks

1. Precompute which pairs `(a, b)` with `a, b ≤ 50` are coprime.
2. DFS from 0. At node `u`, among values `v` coprime with `nums[u]` and with a non-empty stack, pick the top with the greatest depth → `ans[u]`.
3. Push `(u, depth)` on `stack[nums[u]]`, recurse into children, pop.

Example 1 → `[-1,0,0,1]`. Example 2 → `[-1,0,-1,0,0,0,-1]`.

Walking all ancestors is O(n) per node and too slow on a path of 10^5. Use an iterative DFS in languages with small recursion limits.

Time: O(n · 50)  
Space: O(n + 50)

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
