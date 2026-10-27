## Compare directions without division

1. `(x0, y0)`, `(x1, y1)` = the first two points; `dx = x1 − x0`, `dy = y1 − y0`.
2. For each point `(x, y)`: if `dx · (y − y0) ≠ dy · (x − x0)`, return false.
3. Return true.

`[[1,2],[2,3],[3,4],[4,5],[5,6],[6,7]]` → true.

Do not compare slopes with division; vertical lines divide by zero and floats lose precision. Do not compare only neighbouring points' slopes with floats.

Time: O(n)  
Space: O(1)

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
