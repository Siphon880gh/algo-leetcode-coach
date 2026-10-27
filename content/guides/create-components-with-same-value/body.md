## Fix the target, then cut greedily

1. `S = sum(nums)`. For `k = n … 1` with `S mod k = 0`: `t = S / k`.
2. `dfs(u)`: `s = nums[u] +` leftovers of the children; if `s > t` fail; return 0 if `s = t`, else `s`.
3. If `dfs(root)` returns 0, return `k − 1`.

Examples → 2, 0. Checked against trying every set of deleted edges on 300 random small trees.

Values are positive, so a subtree summing to t must be cut off there, and a leftover above t can never be fixed. S ≤ 10^6, so only its divisors up to n are tried.

Time: O(n · d(S))  
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
