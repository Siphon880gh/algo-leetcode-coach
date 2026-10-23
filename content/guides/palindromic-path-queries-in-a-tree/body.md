## Masks plus Fenwick

1. DFS for tin / tout, depth and binary-lifting parents.
2. Fenwick over Euler positions with range XOR, point query. For each u, XOR bit(s[u]) on [tin[u], tout[u]).
3. Update u to c: XOR bit(old) ⊕ bit(c) on u’s range.
4. Query u v: mask = m[u] ⊕ m[v] ⊕ bit(s[lca(u, v)]); answer popcount(mask) ≤ 1.

Examples → [true, false], [false, false, true]. Checked against walking each path on 800 random trees with updates.

Dropping the lca letter: example 1 → [false, false] instead of [true, false].

Time: O((n + q) log n)  
Space: O(n log n)

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
