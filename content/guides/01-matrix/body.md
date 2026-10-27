## Start from all zeros at once

Set `dist = 0` for zeros and `−1` (unknown) for ones. Put every zero in a queue. Pop a cell; for each neighbor with `dist == −1`, set `dist = d + 1` and push it. BFS from many sources reaches each cell first along a shortest route from its nearest zero, so each cell is set once.

DP alternative: pass 1 from top-left takes `min(up, left) + 1`; pass 2 from bottom-right takes `min(current, down + 1, right + 1)`. Two sweeps cover all four directions.

Rotting Oranges (994) is the same multi-source BFS with time instead of distance.

Do not BFS separately from each 1 — that is O((m n)²). Do not start from just one zero; nearest means from any zero.

Time: O(m n)  
Space: O(m n)

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
