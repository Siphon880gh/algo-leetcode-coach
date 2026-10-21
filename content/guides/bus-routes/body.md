## Levels are buses

1. If `source == target`, return 0.
2. `stop_to_routes[s]` = the routes that pass through stop `s`.
3. Start with every route through `source` at level 1 (mark them visited).
4. BFS: for each route at the current level, if it contains `target`, return the level. Otherwise, for every stop on it (each stop processed once), enqueue its unvisited routes at level + 1.
5. Return `-1` if the queue empties.

Store each route as a set to test `target` in O(1), or check membership via `stop_to_routes[target]`.

Do not BFS stop to stop counting stops; riding many stops on one bus costs 1. Do not revisit a route's stops; marking stops visited keeps the total work linear in the route sizes.

Time: O(Σ route lengths)  
Space: O(Σ route lengths)

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
