## Enumerate palindromes, largest first

For `n >= 2`, the answer has `2n` digits. A `2n`-digit palindrome is fixed by its left half `a`. Walk `a` from `10^n − 1` down to `10^(n−1)`. Mirror `a` to build `p` (e.g. `a = 99` → `9999`). Then try factors `t` from `10^n − 1` down while `t · t >= p`; if `p % t == 0`, the other factor `p / t` is at most `t` and still has `n` digits, so `p` works. Return `p % 1337`.

Large palindromes are found quickly, so the loops stop early in practice. `n = 1` is special: the answer is 9 (3 × 3, or 9 × 1), a 1-digit palindrome.

Brute force over all pairs `i × j` is `10^16` for `n = 8`. Many accepted answers also hardcode the eight results, but the enumeration explains why it works.

Palindrome Number (9) checks one number. Prime Palindrome (866) enumerates palindromes in the same way.

Do not reduce mod 1337 before you have the palindrome. Use 64-bit integers: `p` can reach about `10^16`.

Time: hard to bound tightly, fast in practice (the first hit is near the top)  
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
