## Eight rays

1. `qs` = set of queen positions.
2. For each direction `(dx, dy)` with `dx, dy ∈ {−1, 0, 1}` and not both 0: step from the king until off the 8 × 8 board; at the first queen, record it and stop.

King `[0,0]` with queens `[[0,1],[1,0],[4,0],[0,4],[3,3],[2,4]]` → `[[0,1],[1,0],[3,3]]`.

Do not check each queen against the king alone; a nearer queen blocks the ones behind it. Do not keep walking after the first queen in a direction.

Time: O(64)  
Space: O(queens)

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
