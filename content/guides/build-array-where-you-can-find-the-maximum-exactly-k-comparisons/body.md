## Count new maxima

1. `f(i, mx, k)`: ways to fill positions `i..n − 1`.
2. `f(n, mx, k) = [k == 0]`.
3. `f(i, mx, k) = mx · f(i + 1, mx, k) + Σ_{v > mx} f(i + 1, v, k − 1)`.
4. Answer `f(0, 0, K)` mod 10⁹ + 7.

`n = 2, m = 3, k = 1` → 6. `n = 5, m = 2, k = 3` → 0. `n = 9, m = 1, k = 1` → 1.

Do not count arrays by brute force; mⁿ is huge. Prefix sums over `v` cut the inner sum to O(1).

Time: O(n · m² · k), or O(n · m · k) with prefix sums  
Space: O(n · m · k)

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
