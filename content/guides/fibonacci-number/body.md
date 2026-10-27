`0 <= n <= 30`. Return `F(n)` with `F(0) = 0`, `F(1) = 1`, `F(n) = F(n − 1) + F(n − 2)`. `n = 2` → 1. `n = 3` → 2. `n = 4` → 3.

## Two rolling values

Keep `a, b = 0, 1` (that is `F(0), F(1)`). Repeat `n` times: `a, b = b, a + b`. Then `a` is `F(n)`. Only the last two values matter, so O(1) space.

Naive recursion `F(n − 1) + F(n − 2)` repeats work and takes about φ^n calls; memoize it if you want recursion. Matrix power gives O(log n) for huge `n`, but `n <= 30` here.

Climbing Stairs (70) is the same recurrence shifted by one. N-th Tribonacci Number (1137) keeps three values.

Do not return `b` — after `n` steps, `a` holds `F(n)`. Check `n = 0` → 0.

Time: O(n)  
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
