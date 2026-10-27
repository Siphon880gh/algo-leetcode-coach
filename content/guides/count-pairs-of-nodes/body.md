## Overcount, then correct

1. `deg[v]` and `shared[(u, v)]` (multi-edges counted).
2. Sort the degrees once. Per query `q`: two pointers count pairs with `deg[a] + deg[b] > q`.
3. For each connected pair: if `deg[u] + deg[v] > q` but `deg[u] + deg[v] − shared ≤ q`, subtract 1.

Example 1 → `[6,5]`. Example 2 → `[10,10,9,8,6]`.

Only connected pairs can be overcounted; disconnected ones have `shared = 0`. Do not loop over all n² pairs; n reaches 2 · 10^4.

Time: O(n log n + q · (n + E))  
Space: O(n + E)

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
