## Recursion on remaining soup

Let `m = ceil(n / 25)`. `f(a, b)` = the probability that A empties first plus half the probability both empty together:

- `a ≤ 0` and `b ≤ 0` → 0.5.
- `a ≤ 0` → 1.
- `b ≤ 0` → 0.
- Otherwise the average of `f(a − 4, b)`, `f(a − 3, b − 1)`, `f(a − 2, b − 2)`, `f(a − 1, b − 3)`.

Memoize it. Return `f(m, m)`.

On average A loses soup faster than B, so the answer approaches 1 as `n` grows. Once `n ≥ 4800`, it is within 10⁻⁵ of 1; return 1 directly. That bound keeps the memo table small.

Do not run the recursion for `n` up to 10⁹; the shortcut is required. Do not work in milliliters; scaling by 25 shrinks the state space 625-fold.

Time: O(m²) with m ≤ 192  
Space: O(m²)

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
