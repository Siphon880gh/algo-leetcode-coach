## Two passes

1. `total = sum of all nodes`.
2. Post-order: `s = node.val + s(left) + s(right)`; track `best = max(best, s · (total − s))`.
3. Return `best mod (10⁹ + 7)`.

`[1,2,3,4,5,6]` → 110 (11 · 10). `[1,null,2,3,4,null,null,5,6]` → 90 (15 · 6).

Do not apply the modulo before comparing products; that breaks the maximum. Do not use 32-bit integers for the product.

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
