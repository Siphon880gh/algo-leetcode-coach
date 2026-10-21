Given a connected graph of cities with names and a target sequence of names, find a path (a sequence of adjacent cities, same length as the target) minimising the number of positions where the city name differs from the target, and return it. For instance, with target `["A","B","C"]` and a path whose names are A, X, C, the distance is 1. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Layered DP

1. `dp[0][v] = (name[v] ≠ target[0])` for all v.
2. `dp[i][v] = (name[v] ≠ target[i]) + min over neighbours u of dp[i−1][u]`; store the argmin as `par[i][v]`.
3. Pick the best v at the last layer and walk `par` backwards.

For instance, if the target is `["A","B","C"]` and a path A–B–C exists, the answer has distance 0.

Do not search all paths (exponential). Path cities may repeat, which the DP allows naturally.

Time: O(L · E)  
Space: O(L · V)

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
