## One die at a time

1. `dp = [1] + [0] * target` (zero dice, sum 0).
2. Repeat `n` times: `new[s] = Σ dp[s − f]` for `f` in `1..k` with `s − f ≥ 0`, taken mod `10⁹ + 7`; then `dp = new`.
3. Return `dp[target]`.

`n = 2, k = 6, target = 7` → 6. A sliding window sum over `dp` makes each row O(target).

Do not update `dp` in place; every die must be used exactly once. Do not skip the modulo; counts grow huge quickly.

Time: O(n · target · k), or O(n · target) with a window  
Space: O(target)

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
