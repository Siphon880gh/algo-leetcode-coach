## Chains of squares

1. `s = set(nums)`; `best = −1`.
2. For each `x` in `s`: `L = 1`; while `x² ∈ s`: `x = x²`, `L++`. If `L ≥ 2`, `best = max(best, L)`.
3. Return `best`.

Examples → 3, −1.

Values are at least 2 and at most 10^5, so the longest chain is 2, 4, 16, 256, 65536: five values. Each start takes at most 5 steps. Squares reach 10^10, so square in 64-bit or stop once x exceeds 316.

Time: O(n)  
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
