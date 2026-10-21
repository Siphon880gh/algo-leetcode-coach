A directed graph has `n` nodes and a list of `edges` (self-loops and repeated edges are possible). Return true if every path starting at `source` ends at `destination`: at least one path exists, every reachable node with no outgoing edge is `destination`, and no path can go on forever. `n = 3`, `edges = [[0,1],[0,2]]`, `source = 0`, `destination = 2` → false. `n = 4`, `edges = [[0,1],[0,3],[1,2],[2,1]]`, `0 → 3` → false (cycle). `n = 4`, `edges = [[0,1],[0,2],[1,3],[2,3]]`, `0 → 3` → true. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Dead ends and cycles

States: 0 = unvisited, 1 = on the current path, 2 = proven good.

`dfs(u)`:

1. If `state[u] == 1`, return false (cycle).
2. If `state[u] == 2`, return true.
3. If `u` has no outgoing edges, return `u == destination`.
4. `state[u] = 1`. For every `v` in `adj[u]`, if not `dfs(v)`, return false.
5. `state[u] = 2`; return true.

Answer: `dfs(source)`.

If `destination` has an outgoing edge, step 3 never accepts it and the answer comes out false, as it should: paths can continue past it.

Do not use a plain visited set; it cannot tell a cycle from two paths meeting at a node. Do not stop at the first path that reaches destination; every path must.

Time: O(n + e)  
Space: O(n + e)

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
