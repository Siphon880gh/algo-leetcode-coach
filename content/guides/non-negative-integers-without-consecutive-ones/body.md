## Free tails are Fibonacci

Let `f[k]` be the number of k-bit strings (leading zeros allowed) with no `11`: `f[0] = 1`, `f[1] = 2`, `f[k] = f[k − 1] + f[k − 2]`. A valid string either starts with 0 followed by any valid `k − 1` bits, or with `10` followed by any valid `k − 2` bits.

Walk the bits of `n` from the highest, position `i` from about 30 down to 0:

1. If bit `i` is 1, put 0 there instead; every valid tail of `i` bits is then smaller than `n`, so add `f[i]`.
2. If bit `i` and the bit above it are both 1, `n` itself and everything that keeps this prefix contain `11`. Stop and return the total.

If the walk finishes without stopping, `n` itself is valid: add 1.

Generic digit DP (position, previous bit, tight) gives the same count with more code.

Do not loop from 0 to `n`; `n` can be 10⁹. Do not forget the final `+ 1` for `n` itself, or the early stop that skips it.

Time: O(log n)  
Space: O(log n)

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
