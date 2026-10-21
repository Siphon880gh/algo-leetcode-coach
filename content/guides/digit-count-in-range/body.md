Given a digit `d` (0 to 9) and integers `low` and `high` with `1 ≤ low ≤ high ≤ 2·10⁸`, return how many times `d` appears among the digits of all integers in `[low, high]`. `d = 1`, `low = 1`, `high = 13` → 6 (1, 10, 11 twice, 12, 13). `d = 3`, `low = 100`, `high = 250` → 35. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## One position at a time

`count(n, d)` for the numbers 1..n. For each place value `p = 1, 10, 100, …` while `p ≤ n`:

- `hi = n // (p · 10)`, `cur = (n // p) % 10`, `lo = n % p`.
- If `d > 0`: add `hi · p`, plus `p` if `cur > d`, or `lo + 1` if `cur == d`.
- If `d == 0`: when `hi == 0` this place would only hold leading zeros, so add nothing; otherwise add `(hi − 1) · p`, plus `p` if `cur > 0`, or `lo + 1` if `cur == 0`.

Answer: `count(high, d) − count(low − 1, d)`.

Check: `count(100, 0)` gives 10 at the units place and 1 at the tens place, total 11 (10, 20, …, 90 once each, 100 twice).

Do not loop over every number; the range holds up to 2·10⁸ of them. Do not use the `d > 0` rule for zero; it counts zeros in front of the number.

Time: O(log high)  
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
