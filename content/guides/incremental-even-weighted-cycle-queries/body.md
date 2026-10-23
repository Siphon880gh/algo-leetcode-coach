## Parity union-find

1. find(x) returns (root, parity of x relative to root).
2. Edge (u, v, w): same root → add it only if pu ⊕ pv = w. Different roots → join with the root’s parity set to pu ⊕ pv ⊕ w and add it.
3. Return the number of added edges.

Examples → 2, 3. Checked against listing every cycle on 400 random small graphs.

Rejecting every edge that closes a cycle: example 2 → 2 instead of 3.

Time: O(m α(n))  
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
