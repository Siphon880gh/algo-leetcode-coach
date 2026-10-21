## Path reconstruction

1. `adj[u]` lists neighbours from every pair (both directions).
2. Start at any `x` with `len(adj[x]) == 1`.
3. Next = the neighbour of the current element that is not the previous one; repeat until n elements.

`[[2,1],[3,4],[3,2]]` → `[1,2,3,4]`. `[[4,-2],[1,4],[-3,1]]` → `[-2,4,1,-3]` (its reverse is also accepted).

Values can be negative, so use a hash map rather than an offset array unless you shift by 10^5.

Time: O(n)  
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
