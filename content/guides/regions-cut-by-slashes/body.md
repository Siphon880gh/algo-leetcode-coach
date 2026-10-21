## Make the cuts explicit

Number the triangles of cell `(r, c)` as `4 · (r · n + c) + k` with `k` = 0 top, 1 right, 2 bottom, 3 left.

Inside the cell:

- `'/'`: union top with left, right with bottom.
- backslash: union top with right, bottom with left.
- `' '`: union all four.

Across cells:

- The bottom of `(r, c)` with the top of `(r + 1, c)`.
- The right of `(r, c)` with the left of `(r, c + 1)`.

Return the number of components.

An alternative scales each cell to a 3 × 3 pixel block, draws the slashes as pixels, and counts regions with a flood fill.

Do not count cells; a single cell can belong to two regions. Do not mix up which triangles a slash joins: `/` runs from bottom-left to top-right, so it separates top-left from bottom-right.

Time: O(n² α(n))  
Space: O(n²)

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
