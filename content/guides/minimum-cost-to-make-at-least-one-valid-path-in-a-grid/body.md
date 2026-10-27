## Free along the arrow

1. Directions 1–4 are right, left, down, up.
2. Deque from `(0, 0)` with cost 0. For each neighbour, `w = 0` if it is the cell's arrow, else 1.
3. On improvement, push front for `w = 0`, back for `w = 1`.
4. Return the cost at `(m − 1, n − 1)`.

`[[1,1,1,1],[2,2,2,2],[1,1,1,1],[2,2,2,2]]` → 3. `[[1,1,3],[3,2,2],[1,1,4]]` → 0. `[[1,2],[4,3]]` → 1.

Do not use plain BFS; edges have weights 0 and 1. Do not change signs in advance; the cost is paid per move that disagrees with the arrow.

Time: O(m · n)  
Space: O(m · n)

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
