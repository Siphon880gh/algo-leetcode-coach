## Per index

1. near = min(k, ones among i − 1, i, i + 1). c = min(maxChanges, k − near); m = k − c.
2. Cost = 2c + total distance from i of the m nearest ones. Binary-search the radius d holding at least m ones, sum distances with prefix sums of positions, and drop the extra ones at distance d.
3. Return the minimum over i.

Examples → 3, 4. Checked against a breadth-first search over game states on 250 random small arrays.

Changes matter even with enough ones: ignoring them gives example 1 → 4 instead of 3.

Time: O(n log n)  
Space: O(n)

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
