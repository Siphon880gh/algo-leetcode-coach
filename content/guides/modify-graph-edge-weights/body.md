## Incremental edges

1. `d` = shortest distance using only the positive edges. If `d < target`, return []. If `d = target`, set every -1 edge to 2 · 10^9 and return.
2. For each -1 edge in turn: set it to 1 and rerun Dijkstra. If the new `d ≤ target`, add `target − d` to this edge, set the remaining -1 edges to 2 · 10^9, and return.
3. If no edge got there, return [].

Examples → a valid assignment with distance 5, [], [[1,0,4],[1,2,3],[2,3,5],[0,3,1]]. Example 1’s answer differs from the sample but is accepted. Checked on 400 random small graphs: the output is valid and has distance exactly target whenever target lies between the all-ones distance and the positive-only distance, and [] otherwise.

Setting every -1 edge to 1 only works when that already hits target; on example 1 the distance is then 2, so you must stretch an edge. Raising the edge that first brought d to target or below is safe, because every shorter path found earlier was at least target.

Time: O(k · (n + m) log n) for k edges of weight -1  
Space: O(n + m)

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
