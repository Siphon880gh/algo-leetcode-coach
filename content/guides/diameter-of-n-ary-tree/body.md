Given the root of an N-ary tree, return the length of the diameter: the longest path between any two nodes, as the statement measures it (typically in edges). For instance, a root with children A and B, where A has a child C, has diameter 3 edges (C–A–root–B). _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Top two heights

1. `h(node)`: track the two largest `h(child) + 1` (0 if absent).
2. `best = max(best, top1 + top2)`.
3. Return `top1`.

Root with children A, B; A has child C: at the root, top1 = 2 (via A), top2 = 1 (via B) → 3.

Do not assume the diameter passes through the root. Do not sort all children; two variables suffice.

Time: O(n)  
Space: O(height)

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
