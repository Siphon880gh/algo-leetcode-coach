## Edges point one way

1. Edge `i → j` when `(xi − xj)² + (yi − yj)² ≤ ri²`.
2. For each start, DFS or BFS and count the visited bombs.
3. Return the maximum.

Examples → 2, 1, 5. Constructed check: `[[0,0,5],[4,0,1]]` → 2 from the first bomb but only 1 from the second.

Because reach is not symmetric, union-find would merge bombs that cannot trigger each other. With n ≤ 100, n searches over n² edges are cheap. Coordinates up to 10^5 make the squares overflow 32 bits.

Time: O(n³)  
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
