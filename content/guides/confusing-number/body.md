Rotating a digit by 180° turns 0, 1, 6, 8, 9 into 0, 1, 9, 8, 6; the digits 2, 3, 4, 5, 7 become invalid. A confusing number becomes a different valid number when rotated (leading zeros are ignored). Given `n`, return whether it is confusing. `6` → true (9). `89` → true (68). `11` → false. `25` → false. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Rotation reverses the order

`rot = {0:0, 1:1, 6:9, 8:8, 9:6}`. `x = n`, `r = 0`.

While `x > 0`:

- `d = x % 10`. If `d` is not in `rot`, return false.
- `r = r · 10 + rot[d]`; `x //= 10`.

Return `r != n`.

The last digit of `n` becomes the first digit after rotation, which is exactly what building `r` from the last digit does. For `n = 0`, the loop does not run and `r == n`, so 0 is not confusing.

Do not map digits in place without reversing; rotation flips the order too. Do not treat 6 and 9 as unchanged; they swap.

Time: O(log n)  
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
