## Even out the values

1. Min-heap of `nums`.
2. Repeat `k` times: replace the top `x` with `x + 1`.
3. Return the product of the heap mod 10^9 + 7.

Examples → 20, 216.

Raising `a` instead of a larger `b` changes the product by a factor `(a + 1)/a ≥ (b + 1)/b`, so the smallest is always the best choice. k ≤ 10^5, so k heap steps are fine; multiply under the modulus only at the end.

Time: O((n + k) log n)  
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
