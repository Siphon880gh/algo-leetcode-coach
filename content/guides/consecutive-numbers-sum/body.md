## Solve for the start

`n = x + (x + 1) + … + (x + k − 1) = k · x + k(k − 1)/2`, with `x ≥ 1`.

So `x = (n − k(k − 1)/2) / k` must be a positive integer. Loop `k = 1, 2, …` while `k(k + 1)/2 ≤ n` (the smallest sum of length `k`, starting at 1), and count the `k` where `(n − k(k − 1)/2) % k == 0`.

The loop runs about `√(2n)` times.

Equivalent number theory: the answer is the number of odd divisors of `n`.

Do not try every start `x`; `n` is up to 10⁹. Do not forget `k = 1`, the number itself.

Time: O(√n)  
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
