## Integer break

1. `p ≤ 3` → `p`.
2. `p % 3 == 0` → `3^(p/3)`.
3. `p % 3 == 1` → `4 · 3^((p − 4)/3)`.
4. `p % 3 == 2` → `2 · 3^((p − 2)/3)`.

`5` → 2 · 3 = 6. `8` → 2 · 3 · 3 = 18. The formula agreed with a DP over all splits for p < 40.

A nice divisor picks each prime with exponent 1 … e, so the count is the product of the exponents. `primeFactors` reaches 10^9, so use modular exponentiation.

Time: O(log p)  
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
