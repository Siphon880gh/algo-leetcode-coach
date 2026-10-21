A `width × height` matrix of 0s and 1s must have at most `maxOnes` ones in every `sideLength × sideLength` square. Return the largest possible number of ones. For instance, with `width = height = 3`, `sideLength = 2`, and `maxOnes = 1`, the answer is 4 (put the 1s in the four corners). _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Repeat one tile

1. For each tile position `(i, j)` with `0 ≤ i, j < s`: `count = ((width − i − 1) // s + 1) · ((height − j − 1) // s + 1)`.
2. Sort the counts in decreasing order and add the first `maxOnes`.

Any `s × s` square covers each tile position exactly once, so putting 1s at the same `maxOnes` tile positions everywhere is valid, and choosing the most frequent positions is best.

Do not place 1s greedily cell by cell; early choices block better ones. Do not compute the counts as `width / s`; partial tiles at the edges count too.

Time: O(s² log s)  
Space: O(s²)

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
