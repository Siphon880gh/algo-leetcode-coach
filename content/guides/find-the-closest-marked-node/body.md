You get a graph with n nodes and weighted edges, a source node and a list of marked nodes. Return the smallest distance from the source to any marked node, or −1 if no marked node can be reached. The edge format, whether edges are one-way, and the exact limits are in the official statement. For instance, with edges 0–1 of weight 1, 1–2 of weight 1 and 0–3 of weight 5, source 0 and marked nodes [2, 3], the answer is 2; with only an unreachable node marked, it is −1. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Dijkstra once

1. `dist[s] = 0`; Dijkstra over the edges as the statement defines them.
2. Return `min(dist[m] for m in marked)`, or −1 if that is infinity.

Constructed checks (run in code, one-way and two-way edges give the same answers): the example above → 2, and −1 with an unreachable marked node.

Stopping at the marked node with the fewest edges is wrong: that finds node 3 at distance 5 instead of node 2 at 2.

Time: O(E log V)  
Space: O(V + E)

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
