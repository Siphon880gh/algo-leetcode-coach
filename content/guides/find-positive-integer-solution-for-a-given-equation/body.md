## Walk the staircase

1. `x = 1`, `y = 1000`.
2. While `x ≤ 1000` and `y ≥ 1`: `v = f(x, y)`.
   - `v < z`: `x += 1`.
   - `v > z`: `y −= 1`.
   - equal: record `[x, y]`, `x += 1`, `y −= 1`.

Because `f` is strictly increasing in each argument, each step rules out a whole row or column.

`function_id = 1` (x + y), `z = 5` → `[[1,4],[2,3],[3,2],[4,1]]`.

Do not call `f` on all 10⁶ pairs. Do not start both at 1; then a too-small value does not tell you which one to raise.

Time: O(2000) calls  
Space: O(1) besides the output

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
