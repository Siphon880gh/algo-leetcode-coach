The tree has 1 to 3e4 nodes, values −3e4 to 3e4. A consecutive path has neighbors that differ by exactly 1, all increasing or all decreasing, and it may go child → parent → child. Return the longest length in nodes. `[1,2,3]` → 2. `[2,1,3]` → 3 (1 → 2 → 3). _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Two downward runs per node

`dfs(node)` returns `(inc, dec)`:
- `inc` = longest downward path starting at `node` where each child is parent `+ 1`;
- `dec` = the same with `− 1`.

Both start at 1. For each child: if `child.val == node.val + 1`, `inc = max(inc, child.inc + 1)`; if `child.val == node.val − 1`, `dec = max(dec, child.dec + 1)`.

A path through `node` can go down a decreasing run on one side and down an increasing run on the other, which reads as one increasing path. So update `ans = max(ans, inc + dec − 1)` (the node is counted twice). One child can't feed both, since it cannot be both `+ 1` and `− 1`.

Binary Tree Longest Consecutive Sequence (298) only allows parent-to-child increasing paths.

Do not add `inc + dec` without the `− 1`. Do not allow only increasing runs; the path can read in either direction.

Time: O(n)  
Space: O(h)

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
