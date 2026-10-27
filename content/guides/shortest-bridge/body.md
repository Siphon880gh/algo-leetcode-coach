## Multi-source BFS from an island

1. Find any land cell. DFS from it, marking the whole island (for example set it to 2) and enqueueing every cell.
2. BFS with `steps = 0`. For each level, pop every cell and look at its four neighbors:
   - `1`: you reached the other island; return `steps`.
   - `0`: mark it visited (set it to 2) and enqueue.
3. `steps += 1` after each level.

Starting from the whole island at once measures the shortest distance from any of its cells.

Do not BFS from a single cell of the first island; the bridge may start elsewhere. Do not count the first island's cells as flips; distance 0 starts at its boundary.

Time: O(n²)  
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
