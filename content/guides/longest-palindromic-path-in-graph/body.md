## Outward search

1. Seed (i, i, {i}) for every node and (u, v, {u, v}) for every edge with label[u] = label[v].
2. From (l, r, mask): for a neighbour a of l and b of r, both unvisited, a ≠ b, label[a] = label[b], visit (a, b, mask ∪ {a, b}).
3. Answer the largest mask size seen.

Examples → 3, 1, 3. Checked against listing every simple path on 300 random graphs.

Seeding only single nodes (odd lengths): n = 2, edges [[0, 1]], label = "aa" → 1 instead of 2.

Time: O(n⁴ · 2^n)  
Space: O(n² · 2^n)

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
