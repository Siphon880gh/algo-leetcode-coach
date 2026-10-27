Two arrays hold the coefficients of polynomials A(x) and B(x), with index i holding the coefficient of x^i. Return the coefficient array of A(x) · B(x), which has length len(A) + len(B) − 1. The method assumes the arrays can be long enough that the plain double loop is too slow. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Convolution

1. N = power of two ≥ n + m − 1.
2. Transform both arrays (length N), multiply pointwise, inverse transform.
3. result[i] = round(real part) for i < n + m − 1.

Constructed checks (run in code): [1, 2] × [3, 4] → [3, 10, 8]; [2, 0, −1] × [−1, 1] → [−2, 2, 1, −1]. Checked against the double loop on 300 random pairs.

Converting the floating output with int() (truncation) instead of rounding: with numpy, [−572, −268] × [672, −421, −111, 542] gives 60715 instead of 60716 for x¹.

Time: O((n + m) log(n + m))  
Space: O(n + m)

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
