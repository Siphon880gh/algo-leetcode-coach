`maze` is `m` by `n` (1 to 100 each) of 0 (empty) and 1 (wall); its border acts as walls. A ball at `start` rolls up, down, left, or right and keeps rolling until the next cell is a wall. Then it can choose a new direction. Return true if the ball can **stop** at `destination`. The first sample (start `[0,4]`, destination `[4,4]`) → true; destination `[3,2]` → false (the ball can pass through it but never stop there). _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Stopping points are the nodes

Only cells where the ball stops matter. From a stop `(i, j)`, for each of the four directions, step while the next cell is in bounds and 0; the last cell reached is a neighbor stop. BFS or DFS over stops with a visited grid. Return true when you pop `destination`. Each stop is expanded once and each roll is at most `max(m, n)` steps.

The Maze II (505) wants the shortest distance in cells rolled — Dijkstra, since edges have different lengths. The Maze III (499) wants the lexicographically smallest path to a hole. Number of Islands (200) moves one cell at a time.

Do not move one cell per step — the ball cannot stop in the middle of a corridor. Do not return true just because a roll passes over `destination`. Do not forget to mark stops visited, or the search loops forever.

Time: O(m n (m + n))  
Space: O(m n)

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
