## Sweep limits

1. Sort edges by distance; sort query indices by limit.
2. For each query `(p, q, limit)`: union edges with `dis < limit` not yet added.
3. `answer[idx] = find(p) == find(q)`.

Example 1 → `[false,true]`. Example 2 → `[true,false]` (the 13 edge is not strictly below 13).

The limit is strict. Answer queries in sorted order but store results by original index.

Time: O(E log E + Q log Q + (E + Q) α(n))  
Space: O(n + Q)

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
