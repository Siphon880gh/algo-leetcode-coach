## Count set bits in [1, N]

1. price(N) = sum over 1-indexed bits p = x, 2x, … of the count of numbers ≤ N with bit p set (formula above, j = p − 1).
2. Binary-search the largest N with price(N) ≤ k; an upper bound of 2^60 is safe.

Examples → 6, 9. price matches a direct count on 300 random (N, x) up to 3,000; k = 10^15 with x = 8 → 343,778,878,348,159.

Bits are counted from 1 at the least significant end: x = 2 checks the 2nd, 4th, … bits.

Time: O(log² of the bound)  
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
