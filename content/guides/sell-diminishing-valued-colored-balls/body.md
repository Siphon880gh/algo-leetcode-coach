## Threshold then series

1. Binary search the smallest `T` with `Σ max(0, x − T) ≤ orders`.
2. For each `x > T`: add `(x + T + 1)(x − T) / 2`; `orders −= x − T`.
3. Add `orders · T` for the leftover sales at price `T`; return mod 1e9+7.

`[2,5]`, 4 → 14 (5 + 4 + 3 + 2). `[3,5]`, 6 → 19.

Do not simulate ball by ball (orders up to 10^9). Take the modulo only at the end or on 64-bit partial sums.

Time: O(n log max)  
Space: O(1)

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
