## Three cases

1. Look for a node with two incoming edges. If one exists, call the earlier edge `cand1` and the later one `cand2`.
2. Run union-find over all edges **except** `cand2`:
   - A cycle appears (`find(u) == find(v)` for edge `u → v`):
     - If there are candidates, `cand1` is wrong: it is both the duplicate parent and on the cycle. Return `cand1`.
     - Otherwise, return this cycle-closing edge.
   - No cycle: removing `cand2` fixed everything. Return `cand2`.

Skipping `cand2` is the key test: if the graph is a valid tree without it, it was the extra edge. If a cycle remains, the bad edge must be `cand1` or, with no candidates, the edge that closes the cycle.

Do not reuse problem 684 unchanged; on `[[2,1],[3,1],[4,2],[1,4]]` it returns `[1,4]`, but the answer is `[2,1]`, the parent edge that lies on the cycle. Do not always drop the later candidate either; that is right for `[[1,2],[1,3],[2,3]]` → `[2,3]`, but not for the previous example.

Time: O(n · α(n))  
Space: O(n)

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
