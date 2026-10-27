`n` coins, 1 to 2^31 − 1. Row `i` of a staircase needs exactly `i` coins; the last row may be incomplete. Return the number of complete rows. `n = 5` → 2 (rows of 1 and 2, then 2 left over). `n = 8` → 3 (1 + 2 + 3 = 6, then 2 left over).

## Largest k with k(k+1)/2 at most n

`k` full rows cost `k(k+1)/2` coins. That cost grows with `k`, so binary search the largest `k` in `[0, n]` with `k(k+1)/2 <= n`. Use 64-bit math: `k` near 2^31 makes the product overflow 32 bits.

Closed form: solve `k² + k − 2n = 0` → `k = floor((sqrt(8n + 1) − 1) / 2)`. It is O(1), but floating point can land one off for huge `n`; nudge `k` up or down by one and recheck with integer math.

Simulating row by row (subtract 1, 2, 3, …) takes O(sqrt n) steps, about 65 000 for the max input — it passes, but binary search is the clean pattern. Sqrt(x) (69) is the same "largest value whose square fits" search.

Do not return `k + 1` when the last row is partial. Do not compute `k(k+1)/2` in 32-bit ints.

Time: O(log n) (O(1) closed form)  
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
