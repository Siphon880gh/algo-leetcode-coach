Given a positive integer `num` (up to `2³¹ − 1`), return the smallest positive integer whose digits multiply to `num`. Return 0 if there is no such number or if it does not fit in a 32-bit signed integer. `48` → `68`. `15` → `35`. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Fewest digits, smallest first

If `num < 10`, the answer is `num` itself.

Otherwise, for `d` from 9 down to 2: while `num % d == 0`, divide `num` by `d` and record `d`. If `num` is not 1 at the end, it has a prime factor above 7, so return 0.

Using the largest digits first gives the fewest digits, and fewer digits means a smaller number. Then write the digits in increasing order: the digits were collected from large to small, so read them backward. Finally, return 0 if the value exceeds `2³¹ − 1`.

Do not try 2 before 9; `2 · 2 · 2` uses three digits where `8` uses one. Do not forget the overflow check, since a long digit string can exceed 32 bits.

Time: O(log num)  
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
