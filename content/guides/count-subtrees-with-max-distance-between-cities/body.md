## Enumerate subsets

1. Floyd–Warshall (or BFS from each node) for `dist`.
2. For each mask with ≥ 2 cities: count edges with both ends inside; a connected subtree has exactly `|mask| − 1`.
3. Diameter = max `dist` over pairs in the mask; `ans[d − 1] += 1`.

`n = 4`, star at 2 → `[3,4,0]`. `n = 2` → `[1]`. Path of 3 → `[2,1]`.

Distances inside a connected subtree equal tree distances, since tree paths are unique. Do not count single cities.

Time: O(2^n · n²)  
Space: O(n²)

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
