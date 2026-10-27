## Feasible cap

1. `l = lcm(d1, d2)` in 64-bit.
2. `ok(x)`: `x − x/d1 ≥ c1`, `x − x/d2 ≥ c2`, and `x − x/l ≥ c1 + c2`.
3. Binary search the smallest `x` with `ok(x)`, from 1 to about `2 · (c1 + c2)`.

Examples → 4, 3, 15. Checked against a direct assignment check on 300 random small cases.

Numbers divisible by d2 but not d1 can only go to arr1, and the reverse only to arr2; numbers divisible by neither go anywhere. The three conditions say exactly that the shared pool covers what each array still needs. The lcm can reach 10^10 and answers reach about 2 · 10^9, so use 64-bit.

Time: O(log(c1 + c2))  
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
