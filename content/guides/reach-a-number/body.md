## Flip a step to subtract twice it

`target = |target|`. Increase `k` and `sum = 1 + 2 + … + k` until `sum ≥ target` and `(sum − target)` is even. Return `k`.

Why: flipping step `j` from `+` to `−` lowers the sum by `2j`. If the excess `e = sum − target` is even, flip a set of steps that adds up to `e / 2`; subsets of `1 … k` can make every total from 0 to `sum`, and `e / 2 ≤ sum`.

If the excess is odd, adding step `k + 1` changes its parity when `k + 1` is odd; otherwise one more step (`k + 2`) does. So the answer is `k`, `k + 1`, or `k + 2`.

Do not BFS over positions; the target can be 10⁹. Do not stop at the first `sum ≥ target`; the parity must match too.

Time: O(√target)  
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
