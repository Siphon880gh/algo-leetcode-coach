## Backtracking over edges

`dfs(u, path)`:

- If `u == n − 1`, append a copy of `path` to the answer and return.
- For each `v` in `graph[u]`: append `v`, `dfs(v)`, pop `v`.

Start with `path = [0]`.

No visited set is needed: in a DAG a path cannot revisit a node. The number of paths can be exponential (up to `2^(n − 2)`), so the output size dominates.

Memoizing "all paths from u to the target" also works and can share work, but the output size is the same.

Do not store the live path without copying it; later pops would change saved answers. Do not add a visited set that blocks a node for other paths; different paths may share nodes.

Time: O(2ⁿ · n)  
Space: O(n) recursion, plus the output

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
