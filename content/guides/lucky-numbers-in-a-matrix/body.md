## Intersect two sets

1. `rowMin = {min(row)}`, `colMax = {max(col)}`.
2. Return `rowMin ∩ colMax`.

`[[3,7,8],[9,11,13],[15,16,17]]` → `[15]`. `[[1,10,4,2],[9,3,8,7],[15,16,17,12]]` → `[12]`. `[[7,8],[1,2]]` → `[7]`.

Values are distinct, so there is at most one lucky number. Do not check each cell against its whole row and column; that is O(m · n · (m + n)).

Time: O(m · n)  
Space: O(m + n)

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
