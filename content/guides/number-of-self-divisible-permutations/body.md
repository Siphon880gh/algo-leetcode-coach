Given n, count the permutations of 1 … n (positions numbered from 1) in which every value is coprime with its position, that is gcd(value, position) = 1. Limits are in the official statement. For instance, n = 1 → 1, n = 3 → 3 and n = 4 → 4. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Bitmask DP

This assumes n is small enough for a mask over the values; check the official limits.

1. f[0] = 1.
2. For each mask, i = popcount(mask) + 1; for each unused v with gcd(v, i) = 1, `f[mask | bit(v)] += f[mask]`.
3. Return f[all].

Constructed checks (run in code): the examples above; n = 1 … 8 match trying every permutation (1, 1, 3, 4, 28, 16, 256, …).

The position is implied by the mask, so no second index is needed.

Time: O(2^n · n)  
Space: O(2^n)

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
