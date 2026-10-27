## Max of the two gaps

Return `Σ max(|x[i + 1] − x[i]|, |y[i + 1] − y[i]|)`.

`[[1,1],[3,4],[−1,0]]` → 3 + 4 = 7. `[[3,2],[−2,2]]` → 5.

Move diagonally until one coordinate matches, then straight; the total is the larger gap.

Do not use Manhattan distance; diagonal moves cost 1. Do not reorder the points; they must be visited in the given order.

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
