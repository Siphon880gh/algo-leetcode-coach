In an n × m grid, one move goes from the current cell to any other cell in the same row or the same column. Count the ways to go from a given source cell to a given destination cell in exactly k moves, modulo the value in the official statement. Indexing and limits are in the official statement. For instance, in a 3 × 4 grid, from one corner to the opposite corner in 3 moves → 9. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Four states

a = at the destination, b = same row only, c = same column only, d = neither.

1. Start with 1 in the source’s state.
2. Repeat k times:
   - `a' = b + c`
   - `b' = a·(m − 1) + b·(m − 2) + d`
   - `c' = a·(n − 1) + c·(n − 2) + d`
   - `d' = b·(n − 1) + c·(m − 1) + d·(n + m − 4)`
3. Return a.

Constructed checks (run in code): the example above; a 3 × 2 grid between two cells of one column in 2 moves → 1; 200 random small grids match counting every walk.

Time: O(k)  
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
