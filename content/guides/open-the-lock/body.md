## Shortest path in an unweighted graph

1. Put the deadends in a set. If `"0000"` is a deadend, return `-1`.
2. BFS from `"0000"` with depth 0. For each state, generate 8 neighbors: each of the 4 wheels turned `+1` or `−1` mod 10.
3. Skip neighbors in the deadend or visited sets. Return the depth when you pop the target.
4. If the queue empties, return `-1`.

There are only 10⁴ states, so BFS finishes quickly. Bidirectional BFS (from start and target, expanding the smaller frontier) cuts the work further.

Do not forget the wraparound: 9 → 0 and 0 → 9. Do not use DFS; it does not find the shortest path.

Time: O(10⁴ · 8 · 4)  
Space: O(10⁴)

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
