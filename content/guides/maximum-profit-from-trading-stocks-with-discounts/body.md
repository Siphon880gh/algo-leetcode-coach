## Two tables per node

1. f(u, d)[c] = best profit in u’s subtree with cost c, d = whether u’s boss bought.
2. Skip u: knapsack-merge f(child, false) over the children.
3. Buy u at price p = present[u] // 2 if d else present[u]: start at cost p with profit future[u] − p, then merge f(child, true).
4. f(u, d) = the better of the two at each cost; answer max over f(1, false).

Examples → 5, 4, 10, 12. Checked against trying every set of buyers on 300 random hierarchies.

Ignoring the discount: example 1 → 4 instead of 5.

Time: O(n · budget²)  
Space: O(n · budget)

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
