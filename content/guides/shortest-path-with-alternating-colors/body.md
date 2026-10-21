## Double the states

1. Build `adj[color][u]` for red (0) and blue (1) edges.
2. Queue both `(0, red)` and `(0, blue)` at distance 0; mark them visited.
3. Pop `(u, c)` at distance `d`; set `ans[u] = min(ans[u], d)` if unset. For each `v` in `adj[1 − c][u]`, if `(v, 1 − c)` is unvisited, mark it and push it at `d + 1`.
4. Nodes never reached keep −1.

Starting with both colors at node 0 lets the first edge be either color.

Do not track visited per node only; a node reached by a red edge may still need to be reached by a blue one. Self-loops and parallel edges are fine in this scheme.

Time: O(n + red + blue)  
Space: O(n + red + blue)

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
