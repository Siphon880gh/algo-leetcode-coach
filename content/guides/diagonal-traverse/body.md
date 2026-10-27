## One anti-diagonal at a time

Every cell on an anti-diagonal has the same `k = i + j`, from 0 to `m + n − 2`. For each `k`, the first cell is `(0, k)` if `k < n`, else `(k − n + 1, n − 1)`. Step `i += 1, j −= 1` while inside the grid; that lists the diagonal top-right to bottom-left. Even `k` must go bottom-left to top-right, so reverse it before appending. Every cell is visited once.

Direct simulation also works: move up-right; when you hit the top or right edge, step right or down and flip direction; mirror that for down-left. It is easy to get the corner cases wrong (prefer the right/bottom edge test first at corners).

Spiral Matrix (54) walks the border in rings. Diagonal Traverse II (1424) has jagged rows and groups by `i + j` with sorting or BFS.

Do not start every diagonal at row 0 — once `k >= n`, the start is on the last column. Do not flip the parity: `k = 0` goes upward (it has one cell, but `k = 2` must go up too).

Time: O(m n)  
Space: O(1) besides the output (O(min(m, n)) for one diagonal buffer)

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
