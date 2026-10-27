## Two ways

1. Loop: add x when `x mod 3 = 0` or `x mod 5 = 0` or `x mod 7 = 0`.
2. Or let `f(d) = d · m(m + 1)/2` with `m = ⌊n/d⌋`; answer `f(3) + f(5) + f(7) − f(15) − f(21) − f(35) + f(105)`.

Examples → 21, 40, 30. The two ways agree for every n up to 1000, checked in code.

Numbers divisible by two of the divisors are counted twice by the first three terms, so they are subtracted once; numbers divisible by all three come back in with f(105).

Time: O(n) or O(1)  
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
