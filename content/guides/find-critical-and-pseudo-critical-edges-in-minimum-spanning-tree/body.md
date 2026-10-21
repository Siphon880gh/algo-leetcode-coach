## Two Kruskal runs per edge

1. `base = kruskal()`.
2. For each edge `i`: if `kruskal(skip = i) > base` (∞ if disconnected) → critical.
3. Else if `kruskal(force = i) == base` → pseudo-critical.

n = 5 example → `[[0,1],[2,3,4,5]]`. n = 4 square of weight-1 edges → `[[],[0,1,2,3]]`.

Do not test forcing for critical edges too; critical takes precedence. Sort once and reuse the order (keep original indices).

Time: O(E² · α(n))  
Space: O(n + E)

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
