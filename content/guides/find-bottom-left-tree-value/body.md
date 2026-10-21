## Level-order and remember the first

BFS with a queue. At the start of each level, set `ans = q[0].val` (the leftmost node of that level), then pop the whole level and push children left before right. When the queue empties, `ans` is from the deepest level.

Shortcut: push the right child before the left. Then the very last node popped is the bottom-left one.

DFS: track the max depth seen; visit left before right and update `ans` only when the depth is strictly greater than the max. The first node reached at a new depth is the leftmost.

Do not return the leftmost node of the whole tree (keep going left from the root) — in example 2 that is 4, but 7 is deeper. Do not update on equal depth in DFS — that keeps the rightmost.

Time: O(n)  
Space: O(width) for BFS, O(h) for DFS

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
