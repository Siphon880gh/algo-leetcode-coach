## Feasibility search

1. `lo = max(jobs)`, `hi = sum(jobs)`; sort jobs descending.
2. `ok(T)`: place job `i` into any worker with `load + job ≤ T`; skip duplicate loads at the same step (symmetric workers); recurse.
3. Binary search the smallest `T` with `ok(T)`.

`[3,2,3]`, 3 → 3. `[1,2,4,7,8]`, 2 → 11.

Alternative: bitmask DP `dp[j][mask]` over subsets with precomputed subset sums (O(k · 3^n)). n ≤ 12 keeps both feasible. The duplicate-load skip is what keeps backtracking fast.

Time: O(log(sum) · k^n) worst case, fast with pruning  
Space: O(n + k)

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
