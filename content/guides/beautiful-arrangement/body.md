## Fill one position at a time

`dfs(i)`: if `i > n`, count one. Otherwise, for each unused `x` with `x % i == 0 or i % x == 0`, mark it, call `dfs(i + 1)`, and unmark it. Precomputing the valid `x` list for each position keeps the inner loop short. The divisibility rule prunes most branches, so this is fast for `n <= 15`.

Bitmask DP: `f[mask]` = ways to fill the first `popcount(mask)` positions using exactly the numbers in `mask`. For each `x` not in `mask` that fits position `popcount(mask) + 1`, add `f[mask]` to `f[mask | bit(x)]`. Answer `f[full]`. O(2^n · n).

Beautiful Arrangement II (667) builds one arrangement with a given number of distinct differences — a different problem.

Do not generate all `n!` permutations and filter — 15! is about 1.3e12. Do not use 0-indexed positions; the rule is 1-indexed.

Time: O(2^n · n) with DP; backtracking is much smaller than n! in practice  
Space: O(2^n) for DP, O(n) for backtracking

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
