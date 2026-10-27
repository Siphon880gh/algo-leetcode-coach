## One max per level

BFS: while the queue is non-empty, take `size = len(q)`, pop `size` nodes, track `mx` and push their children; append `mx`. Empty root → `[]`.

DFS: `dfs(node, d)`. If `d == len(ans)`, append `node.val`; else `ans[d] = max(ans[d], node.val)`. Recurse on both children with `d + 1`.

Binary Tree Level Order Traversal (102) has the same skeleton; Average of Levels (637) averages instead.

Do not start `mx` at 0 — rows can be all negative. Start at negative infinity or the first node's value.

Time: O(n)  
Space: O(width) for BFS, O(h) for DFS

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
