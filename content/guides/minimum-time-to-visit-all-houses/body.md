n houses stand on a circle. Each pair of neighbours is joined by a road whose length depends on the direction you walk it: forward[i] for the step from house i to the next house, and backward[i] for the step from house i to the previous house (this guide assumes that indexing). Starting at house 0, visit the houses in queries in order and return the minimum total distance walked. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Both ways round

1. F = prefix sums of forward; B = prefix sums of backward taken in the direction you walk them.
2. clockwise(a, b) and counter(a, b) come from differences of F or B, adding the full loop when the walk wraps past house 0.
3. Sum min(clockwise, counter) over consecutive targets, starting from house 0.

Constructed checks (run in code): forward = [2, 2, 2], backward = [1, 1, 1], queries = [2, 1] → 2; forward = [1, 5, 1, 1], backward = [3, 3, 3, 3], queries = [2, 3] → 7. Checked against Dijkstra on the circle on 300 random cases.

Always walking clockwise: the first check → 8 instead of 2.

Time: O(n + q)  
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
