## Reduce to ax = b

Split at `=`. For each side, scan the terms (each starts with an optional sign):

- A term ending in `x` adds to the coefficient: `x` and `+x` are 1, `-x` is −1, `0x` is 0, `3x` is 3.
- Any other term adds to the constant.

With left `(a, b)` and right `(c, d)`, the equation is `(a − c) · x = d − b`.

- If `a == c`: return `"Infinite solutions"` when `b == d`, else `"No solution"`.
- Otherwise return `"x=" + str((d − b) // (a − c))`; the problem guarantees an integer answer.

A neat trick for splitting: insert a separator before every `+` and `-`, then split.

Do not read a bare `x` as coefficient 0; it is 1. Do not forget `0x`; its coefficient really is 0.

Time: O(n)  
Space: O(1) besides the term list

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
