## Max-product Dijkstra

1. `best[start] = 1`; push `(1, start)` into a max-heap.
2. Pop `(p, u)`; skip if `p < best[u]`; return `p` if `u == end`.
3. For each `(v, w)`: if `p · w > best[v]`, update and push.
4. Return 0 if end is never reached.

Edges `[[0,1],[1,2],[0,2]]` with probabilities `[0.5,0.5,0.2]` → 0.25; with `[0.5,0.5,0.3]` → 0.3. Unreachable → 0.

Do not use plain BFS; edge weights differ. Taking −log(p) and running shortest-path Dijkstra is equivalent.

Time: O((V + E) log V)  
Space: O(V + E)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
