## Index into the halves

1. `h = (L + 1) / 2`, `base = 10^(h − 1)`.
2. For each `q`: `x = base + q − 1`; if `x ≥ 10^h`, answer −1.
3. Otherwise answer `x` followed by the reverse of `x` without its last digit when `L` is odd.

Examples → `[101,111,121,131,141,999]`, `[1111,1331,1551]`. Checked against listing every palindrome for L up to 5.

The first half starts with a non-zero digit, so there are `9 · 10^(h − 1)` palindromes of length L. Values reach 10^15, so use 64-bit.

Time: O(len(queries) · L)  
Space: O(1) besides the output

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
