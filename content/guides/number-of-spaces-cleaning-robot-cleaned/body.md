A room is a 0-indexed binary grid where 0 is an empty space and 1 is an object; the top-left cell is empty. A robot starts there facing right and cleans every space it visits. It moves straight ahead until the next cell is an object or off the grid, then turns 90 degrees clockwise and continues, forever. Return the number of distinct spaces it cleans. For instance, [[0,0,0],[1,1,0],[0,0,0]] → 7 and [[0,1,0],[1,0,0],[0,0,0]] → 1. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Deterministic walk

1. `r = c = 0`, `d = right`; `seen` states, `cleaned` cells.
2. Loop: if `(r, c, d)` is in `seen`, stop; add it; add `(r, c)` to `cleaned`.
3. If the next cell in direction `d` is inside and empty, move; else turn clockwise.
4. Return `|cleaned|`.

Constructed checks (verified with code): the two cases above → 7, 1, and `[[0,0],[0,0]]` → 4.

There are at most `4 · m · n` states, so the loop ends. A turn in place is its own state, which also handles a robot boxed in on all sides (it spins, repeats, and stops).

Time: O(mn)  
Space: O(mn)

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
