`nums` has 1 to 2000 values from −1e6 to 1e6. Return true if there are indexes `0 < i`, `i + 1 < j`, `j + 1 < k < n − 1` such that the four subarrays `(0, i − 1)`, `(i + 1, j − 1)`, `(j + 1, k − 1)`, `(k + 1, n − 1)` have equal sums (the elements at `i`, `j`, `k` are dropped). `[1,2,1,2,1,2,1]` → true (`i = 1, j = 3, k = 5`, every part sums to 1). `[1,2,1,2,1,2,1,2]` → false. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Meet at the middle cut

Prefix sums `s` with `s[x]` = sum of `nums[0..x]` make each part an O(1) difference.

For each `j` from 3 to `n − 4`:

1. For each `i` from 1 to `j − 2`: if `s[i − 1] == s[j − 1] − s[i]`, add that sum to a set `seen`.
2. For each `k` from `j + 2` to `n − 2`: let `t = s[k − 1] − s[j]` (part 3). If `t == s[n − 1] − s[k]` (part 4) and `t` is in `seen`, return true.

Return false. Fixing the middle splits the problem into two independent halves joined by a set.

Do not try all triples — O(n³) is 8e9. Do not forget the gaps (`i + 1 < j`, `j + 1 < k`); the cut elements are excluded from every part.

Time: O(n²)  
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
