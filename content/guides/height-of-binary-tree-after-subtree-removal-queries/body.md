## Cut a block out of the visit order

1. DFS from the root, appending each node’s depth to `order`; record `tin[v]` on entry and `tout[v]` as the last index of its subtree.
2. `pre[i]` = max of `order[0 … i − 1]`; `suf[i]` = max of `order[i …]`.
3. For query `v`: answer `max(pre[tin[v]], suf[tout[v] + 1])`.

Examples → [2], [3,2,3,2]. Checked against recomputing the height for every query on 300 random trees.

The root is never removed and sits at index 0, so the answer is at least 0. A path-shaped tree is 10^5 deep, so use an explicit stack instead of recursion. Another approach keeps the two largest heights on each level.

Time: O(n + m)  
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
