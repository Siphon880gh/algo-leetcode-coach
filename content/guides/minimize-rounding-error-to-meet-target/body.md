`prices` are strings with three decimals, such as `"0.700"`, and `target` is an integer. Round each price down or up so the rounded prices sum to `target`, minimizing the total rounding error `Σ |rounded − price|`. Return the error as a string with three decimals, or `"-1"` if `target` cannot be reached. `["0.700","2.800","4.900"]`, `target = 8` → `"1.000"`. `["1.500","2.500","3.500"]`, `target = 10` → `"-1"`. `["1.500","2.500","3.500"]`, `target = 9` → `"1.500"`. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Count the round-ups, then choose them

1. For each price, `f` = its fractional part. Sum the floors into `low`; keep the non-zero fractions in a list.
2. `k = target − low`. If `k < 0` or `k > len(fractions)`, return `"-1"`.
3. Sort the fractions in descending order. Round up the first `k`: error `Σ (1 − f)`. Round down the rest: error `Σ f`.
4. Format the error with three decimals.

Rounding `f` up instead of down changes the error by `1 − 2f`, so larger fractions are cheaper to round up.

Do not let integer prices count as round-ups; they cannot change. Work in thousandths (integers) to avoid floating-point drift in the comparisons and the output.

Time: O(n log n)  
Space: O(n)

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
