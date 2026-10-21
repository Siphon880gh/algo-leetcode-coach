## Small state space

Flatten the board to a string. Precompute the neighbors of each index on the 2 × 3 grid:

`0: [1, 3]`, `1: [0, 2, 4]`, `2: [1, 5]`, `3: [0, 4]`, `4: [1, 3, 5]`, `5: [2, 4]`.

BFS: pop a state; if it equals `"123450"`, return its depth. Otherwise find the 0, swap it with each neighbor index to get the next states, and enqueue unseen ones.

Only half of the 720 permutations can reach the goal; the BFS exhausts in at most 360 states and returns `-1` for the others. A parity check on inversions can detect that up front.

Do not use DFS; BFS gives the fewest moves. Do not move the 0 across rows by index ± 1; index 2 and index 3 are not neighbors, which is why the neighbor table is used.

Time: O(6! · 6)  
Space: O(6!)

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
