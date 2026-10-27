A binary tree of depth at most 4 is given as a list of three-digit integers. In each number, the hundreds digit is the depth `d` (1 to 4), the tens digit is the position `p` within that level (1 to 8, as in a full binary tree), and the units digit is the value `v` (0 to 9). Return the sum of all root-to-leaf path sums. `[113,215,221]` → 12 (paths 3 + 5 and 3 + 1). _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Positions like a full tree

1. Store `val[(d, p)] = v` for every number (`d = x // 100`, `p = x // 10 % 10`, `v = x % 10`).
2. `dfs(d, p, s)`: add the node's value to `s`. Let `L = (d + 1, 2p − 1)` and `R = (d + 1, 2p)`. If neither is in the map, it is a leaf: add `s` to the answer. Otherwise recurse into the children that exist.

Start with `dfs(1, 1, 0)`.

The position numbering matches a full binary tree, so `2p − 1` and `2p` find the children directly, without building nodes.

Do not treat a node with one child as a leaf; it is a leaf only when both children are missing. Do not sum all node values; each node counts once per leaf below it.

Time: O(n)  
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
