A `height × width` grid has one tree, one squirrel, and a list of nuts. The squirrel moves one cell up, down, left or right per step and can carry one nut at a time. It must bring every nut to the tree. Return the fewest steps. Tree `[2,2]`, squirrel `[4,4]`, nuts `[[3,0],[2,5]]` in a 5 × 7 grid → 12. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Round trips, except the first

Let `d` be the Manhattan distance. After the first nut, the squirrel always starts at the tree, so every nut costs `2 · d(nut, tree)`.

The first nut is different: the squirrel walks `d(squirrel, nut)` to get it instead of `d(tree, nut)`. So

`answer = Σ 2 · d(nut, tree) − max over nuts of (d(nut, tree) − d(squirrel, nut))`.

Do not send the squirrel to its nearest nut by default; the best first nut balances both distances. Do not clamp the saving at 0: some nut has to go first, so a negative best saving still counts.

Time: O(n)  
Space: O(1)

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
