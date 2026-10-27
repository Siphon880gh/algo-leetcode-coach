## The number itself overflows; the remainder does not

1. If `k % 2 == 0` or `k % 5 == 0`, return −1 (a number ending in 1 is never divisible by 2 or 5).
2. `r = 0`. For `length` from 1 to `k`: `r = (r · 10 + 1) % k`; if `r == 0`, return `length`.
3. Return −1 (not reached when step 1 passed).

There are only `k` remainders, so the sequence repeats within `k` steps; with 2 and 5 excluded, it reaches 0.

Do not build the repunit as an integer; it has up to `k` digits. Do not loop forever; cap the loop at `k` steps.

Time: O(k)  
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
