## Group subsets

1. If any value appears more than k times, return −1.
2. `cost[s]` for subsets `s` of size `n / k` with distinct values.
3. `dp[0] = 0`; for `mask`, let `low` = lowest unused index; for each valid `s` containing `low` and disjoint from `mask`: `dp[mask | s] = min(…, dp[mask] + cost[s])`.

`[1,2,1,4]`, 2 → 4. `[6,3,8,1,3,1,2,2]`, 4 → 6. `[5,3,3,6,3,3]`, 3 → −1.

n ≤ 16 keeps `2^16` masks. Forcing the lowest index into the next group removes duplicate orderings.

Time: O(2^n · C(n, n/k)) worst case  
Space: O(2^n)

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
