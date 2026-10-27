## Full and partial states

Let `f[i]` be the tilings of a full `2 × i` board and `p[i]` the tilings of `i` columns where the last column has only its top cell covered (a full `2 × (i − 1)` board plus one cell; by symmetry, the bottom case is the same). So `p[1] = 0` and `p[2] = 1`.

- `f[i] = f[i − 1] + f[i − 2] + 2 · p[i − 1]`: a vertical domino, two horizontal dominoes, or a tromino closing a partial board (top or bottom).
- `p[i] = p[i − 1] + f[i − 2]`: a horizontal domino extends the partial board, or a tromino starts one.

Eliminating `p` gives `f[n] = 2 · f[n − 1] + f[n − 3]`, with `f[0] = 1, f[1] = 1, f[2] = 2`. Take everything mod 10⁹ + 7.

Do not forget the tromino states; dominoes alone give Fibonacci numbers. Do not apply the short recurrence for `n < 3` without the base cases.

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
