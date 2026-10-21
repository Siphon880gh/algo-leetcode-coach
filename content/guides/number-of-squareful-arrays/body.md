## Prune at each step

Sort `nums`. `used = [False] * n`.

`dfs(prev, depth)`:

1. If `depth == n`, count 1.
2. For each `i` not used:
   - Skip if `i > 0`, `nums[i] == nums[i − 1]` and `not used[i − 1]` (same value already tried here).
   - Skip if `depth > 0` and `prev + nums[i]` is not a perfect square.
   - Mark, recurse with `nums[i]`, unmark.

Return the count.

`isSquare(s)`: `r = isqrt(s)`; `r * r == s`.

With n ≤ 12 and strong pruning, this is fast. A bitmask DP over (used set, last index) also works in O(2ⁿ · n²) with duplicates divided out at the end.

Do not count permutations of positions and forget duplicates; `[2,2,2]` has one answer, not six. Do not check only some adjacent pairs; every neighbor pair must be squareful.

Time: O(n!) worst case, much less with pruning  
Space: O(n)

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
