## One fill per island

For each cell with value 1, run a flood fill that returns the island's size:

- Out of bounds or water → 0.
- Otherwise mark it (set it to 0, or use a visited grid) and return `1 + ` the sizes from its four neighbors.

Take the maximum over all fills; 0 if there is no land.

Each cell is filled at most once, so the whole scan is linear. Use an explicit stack or BFS if recursion depth is a concern (a 50 × 50 grid is fine either way).

Do not forget to mark a cell **before** recursing into its neighbors, or two neighbors will count each other forever. Do not count diagonal neighbors; connection is 4-directional.

Time: O(m · n)  
Space: O(m · n)

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
