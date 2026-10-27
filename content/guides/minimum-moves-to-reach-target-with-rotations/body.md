## State (r, c, orientation)

`(r, c)` is the tail (top or left cell); orientation 0 = horizontal, 1 = vertical.

- **Horizontal:** right if `(r, c + 2)` is free → `(r, c + 1, 0)`. If `(r + 1, c)` and `(r + 1, c + 1)` are free: down → `(r + 1, c, 0)` and rotate clockwise → `(r, c, 1)`.
- **Vertical:** down if `(r + 2, c)` is free → `(r + 1, c, 1)`. If `(r, c + 1)` and `(r + 1, c + 1)` are free: right → `(r, c + 1, 1)` and rotate counterclockwise → `(r, c, 0)`.

Start at `(0, 0, 0)`; the target is `(n − 1, n − 2, 0)`. Return the BFS distance or −1. Example 1 → 11, example 2 → 9.

Do not track cells alone; the same cell can be reached in two orientations. Do not check only the target cell when rotating; both cells under (or right of) the snake must be free.

Time: O(n²)  
Space: O(n²)

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
