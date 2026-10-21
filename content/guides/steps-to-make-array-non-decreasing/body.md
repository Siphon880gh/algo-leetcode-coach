## When does each element die?

1. Stack of `(value, t)`; `ans = 0`.
2. For each `x`: `t = 0`; while the top value `≤ x`: `t = max(t, top.t)`, pop.
3. If the stack is non-empty, `t = t + 1`; else `t = 0`. Push `(x, t)`; `ans = max(ans, t)`.

Examples → 3, 0. Checked against direct simulation on 500 random arrays.

`x` is eaten by the nearest larger value on its left, but only after the smaller values between them are gone, hence one more than the slowest of them. Popping equal values too matters: with only strictly smaller pops, Example 1 → 2 instead of 3.

Time: O(n)  
Space: O(n)

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
