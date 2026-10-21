There are `n` courses labeled 1 to `n` and prerequisite pairs `[prev, next]`. In one semester you can take any number of courses whose prerequisites are all done. Return the fewest semesters needed to take every course, or −1 if the prerequisites form a cycle. For instance, `n = 3` with `[[1,3],[2,3]]` needs 2 semesters, while `[[1,2],[2,3],[3,1]]` gives −1. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## One BFS layer per semester

1. Build adjacency lists and in-degrees.
2. Queue every course with in-degree 0; `semesters = 0`, `taken = 0`.
3. While the queue is non-empty: `semesters += 1`; process the whole current layer, counting `taken` and decrementing each successor's in-degree, queueing those that reach 0.
4. Return `semesters` if `taken == n`, else −1.

Taking every available course each semester is optimal, so the answer is the length of the longest prerequisite chain.

Do not count courses as semesters; one layer can hold many courses. A DFS for the longest path with cycle detection works too.

Time: O(n + E)  
Space: O(n + E)

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
