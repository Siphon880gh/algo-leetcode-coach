## Count per bit, not per pair

A pair differs at bit `i` exactly when one value has a 1 there and the other has a 0. If `a` values have bit `i` set, the number of such pairs is `a · (n − a)`. Sum that over the 30 or 32 bit positions.

All pairs with Hamming Distance (461) is `n²/2 · 32` work — about 1.6e9 bit checks at n = 1e4, too slow. The per-bit count is `32 · n`.

The total can reach about `30 · 5e3 · 5e3 = 7.5e8`, which fits in 32 bits, but 64-bit accumulation is the safe habit.

Hamming Distance (461) is one pair. Sum of All Subset XOR Totals (1863) and Count Pairs With XOR in a Range (1803) are other per-bit counting problems.

Do not loop over all pairs. Do not count `a · a` or `a · n` — only ones paired with zeros differ.

Time: O(32 n)  
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
