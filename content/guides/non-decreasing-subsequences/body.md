## Choose the next element, once per value per level

`dfs(start, path)`: if `path` has at least 2 values, record a copy. Then make a fresh set `used` for this level. For `i` from `start` to `n − 1`: skip if `path` is not empty and `nums[i] < path[-1]`; skip if `nums[i]` is already in `used`. Otherwise add it to `used`, push `nums[i]`, recurse with `i + 1`, pop.

The per-level set is what removes duplicates: two equal values at the same depth would start identical subtrees, so only the first one is explored. You cannot sort first (as in Subsets II, 90), because the order of the original array defines which subsequences exist.

Alternative from doocs: walk index by index with "take or skip"; take when `nums[u] >= last`, and only allow skipping when `nums[u] != last`. That rule also avoids duplicates.

Longest Increasing Subsequence (300) wants one length, not all lists. Subsets II (90) can sort.

Do not dedupe by putting whole lists in a set at the end — it works but wastes the search. Do not sort the input.

Time: O(2^n · n)  
Space: O(n) recursion, plus the output

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
