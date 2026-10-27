Given a positive integer k and two digits digit1 and digit2, return the smallest integer that is larger than k, is a multiple of k, and is written using only digit1 and/or digit2. Return −1 if no such integer exists or it does not fit in a signed 32-bit integer. For instance, k = 2 with digits 0 and 2 → 20; k = 3 with digits 4 and 2 → 24; k = 2 with digits 0 and 0 → −1. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Generate candidates in order

1. `ds` = the sorted distinct digits; starting values are the nonzero ones.
2. For length 1 … 10: scan the current numbers in increasing order; return the first `x` with `x > k`, `x % k == 0`, `x ≤ 2^31 − 1`. Then extend every number by each digit (`x · 10 + d`).
3. Return `−1`.

Constructed checks (verified against a direct search on random inputs): the three cases above → 20, 24, −1.

Shorter numbers are always smaller, and within one length sorting gives increasing order, so the first hit is the minimum. A BFS queue that appends the smaller digit first produces the same order. Use 64-bit arithmetic while extending, since 10-digit values exceed 32 bits.

Time: O(2^10)  
Space: O(2^10)

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
