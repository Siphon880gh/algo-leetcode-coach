## Repeating decimals are fractions

For `"I.N(R)"` with `a = len(N)` and `b = len(R)`:

- `0.(R)` equals `R / (10^b − 1)`, so `0.N(R)` = `N / 10^a + R / (10^a · (10^b − 1))`.
- Add `I`.

Missing parts count as 0 (and skip the repeating term when `R` is empty).

Use exact fractions (Python's `Fraction`, or numerators and denominators with gcd) and compare.

This handles cases like `"0.(9)"` == `"1."` and `"0.9(9)"` == `"1."`.

A shortcut also works: expand the repeating part many times (say 20 digits) and compare as floats with a small tolerance, but exact fractions avoid any doubt.

Do not compare the strings directly; different forms can be equal. Do not drop the repeating part; `0.(52)` is not `0.52`.

Time: O(1) (strings are at most 8 characters per part)  
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
