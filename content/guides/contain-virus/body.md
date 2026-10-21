## One day

1. BFS or DFS over each infected (1) region that is not walled. For each region record:
   - its cells,
   - the **set** of healthy neighbor cells it threatens,
   - the number of walls: count every (infected cell, healthy neighbor) edge, which can be more than the set size.
2. If no region threatens anything, stop.
3. Pick the region with the largest threatened set. Add its wall count to the answer and mark its cells as contained (for example, `−1`).
4. Every other region infects all cells in its threatened set.

Repeat. The problem guarantees no ties for the most threatened cells.

Do not use the threatened-cell count as the wall count; one healthy cell bordering two infected cells needs two walls. Do not let contained regions spread or be chosen again.

Time: O(m · n) per day; each day walls one region, so O((m · n)²) in the worst case  
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
