## Max-weight non-decreasing subsequence

1. Sort pairs by age, then score.
2. `dp[i] = s[i] + max(dp[j] for j < i if s[j] ≤ s[i])` (default 0).
3. Return `max(dp)`.

`[1,3,5,10,15]` / `[1..5]` → 34. `[4,5,6,5]` / `[2,1,2,1]` → 16. `[1,2,3,5]` / `[8,9,10,1]` → 6.

Sorting ties by score lets equal ages chain. A Fenwick tree over scores gives O(n log n); n ≤ 1000 makes O(n²) fine.

Time: O(n²)  
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
