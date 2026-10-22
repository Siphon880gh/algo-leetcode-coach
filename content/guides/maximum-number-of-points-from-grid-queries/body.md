## Expand by value

1. Push `(grid[0][0], 0, 0)`; mark it seen; `cnt = 0`.
2. For each query `q` in increasing order: while the heap’s smallest value is `< q`, pop it, `cnt++`, and push unseen neighbours. Record `cnt` for `q`.
3. Return the counts in the original query order.

Examples → [5,8,1], [0].

The region for a larger query contains the region for a smaller one, so the heap never restarts. The comparison is strict: a cell equal to the query blocks, which is why Example 2 gives 0. Running a BFS per query would cost up to 10^4 · 10^5 = 10^9 steps.

Time: O(m · n log(m · n) + k log k)  
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
