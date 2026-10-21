Rotating a digit by 180° turns 0, 1, 6, 8, 9 into 0, 1, 9, 8, 6; other digits become invalid. A confusing number becomes a different valid number when rotated. Given `n` (up to 10⁹), return how many confusing numbers lie in `[1, n]`. `n = 20` → 6 (6, 9, 10, 16, 18, 19). `n = 100` → 19. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Enumerate valid numbers only

`rot = {0:0, 1:1, 6:9, 8:8, 9:6}`. `dfs(x, r, p)`, where `r` is the rotation of `x` and `p` is the place value for the next rotated digit:

- If `x != r`, count it.
- For each digit `d` in `rot`: `y = x · 10 + d`; if `y > n`, stop (digits are tried in increasing order); else `dfs(y, rot[d] · p + r, p · 10)`.

Start with `dfs(d, rot[d], 10)` for each non-zero `d` in `rot` with `d ≤ n`.

Appending `d` on the right puts its rotation on the left of the rotated number, which is why it is multiplied by `p`.

At most 5^10 candidates exist below 10¹⁰, so the search stays manageable. Do not test every number up to `n`; that is 10⁹ checks. Do not start numbers with 0; that double counts.

Time: O(5^digits)  
Space: O(digits) recursion

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
