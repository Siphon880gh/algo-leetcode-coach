## Counts plus LCA

1. DFS from 0: depth, parent, and `cnt[v][w]` for w = 1 … 26.
2. Binary lifting for the LCA.
3. Per query: `c[w] = cnt[a][w] + cnt[b][w] − 2·cnt[l][w]`; answer `sum(c) − max(c)`.

Examples → [0, 0, 1, 3], [1, 2, 2, 3]. Checked against walking every path on 300 random trees.

Walking each path is O(n) per query, about 2 · 10^8 steps at the limits.

Time: O((n + m)(26 + log n))  
Space: O(26n + n log n)

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
