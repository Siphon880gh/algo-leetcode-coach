## Only reachable positions matter

1. `w = min(arrLen, steps // 2 + 1)`; `dp = [1] + [0] * (w − 1)`.
2. Repeat `steps` times: `new[i] = dp[i] + dp[i − 1] + dp[i + 1]` (missing neighbours count 0), mod `10⁹ + 7`.
3. Return `dp[0]`.

`steps = 3, arrLen = 2` → 4. `steps = 4, arrLen = 2` → 8.

Do not allocate `arrLen` cells; it can be 10⁶ while only `steps / 2 + 1` are reachable and useful. Do not step outside the array; edges have fewer moves.

Time: O(steps · min(arrLen, steps))  
Space: O(min(arrLen, steps))

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
