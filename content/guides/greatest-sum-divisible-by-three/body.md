## Three states

1. `dp = [0, −∞, −∞]`.
2. For each `x`: `nd = dp[:]`; for each `r`, `nd[(r + x) % 3] = max(nd[(r + x) % 3], dp[r] + x)`; `dp = nd`.
3. Return `dp[0]`.

`[3,6,5,1,8]` → 18. `[4]` → 0. `[1,2,3,4,4]` → 12.

Greedy alternative: take the total, and if it is not divisible by 3, drop the cheapest one or two numbers with the right remainders.

Do not update `dp` in place; a number would be used twice. Do not start the other states at 0; they are unreachable at first.

Time: O(n)  
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
