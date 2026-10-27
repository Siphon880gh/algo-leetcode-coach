## Fix the number of 1s, then solve for k

All 1s with `m + 1` digits means `n = 1 + k + k² + … + k^m`. For a fixed `m`, that sum grows with `k`, so at most one `k` works. A longer string of 1s needs a smaller base, so try `m` from largest to smallest and return the first `k` that matches.

`m` is at most about 60, since `2^60 > 1e18`. For each `m` from 60 down to 2, binary search `k` in `[2, n − 1]` comparing the geometric sum with `n` — stop adding as soon as the sum passes `n` to avoid overflow. Or use the fact that `k^m < n < (k + 1)^m`, so `k = floor(n^(1/m))`; check that one value exactly with integer math.

If no `m >= 2` works, return `n − 1`: every `n` is `11` in base `n − 1`.

Convert to Base −2 (1017) and Base 7 (504) are conversions, not searches for a base.

Do not try bases from 2 upward — `n` can be 1e18. Do not compute the sum in floating point. Guard overflow in 64-bit languages.

Time: O(log² n) with binary search per m (O(log n) with the root shortcut)  
Space: O(1)

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
