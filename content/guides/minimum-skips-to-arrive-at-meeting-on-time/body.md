## Skip or rest per road

1. `dp[0] = 0`, others ∞ (values are time × speed).
2. For road `i` with length `d`: `t = dp[k] + d`.
   - Rest (not after the last road): `new[k] = min(…, ceil(t / speed) · speed)`.
   - Skip: `new[k + 1] = min(…, t)`.
3. Smallest `k` with `dp[k] ≤ hoursBefore · speed`; none → −1.

`[1,3,2], 4, 2` → 1. `[7,3,5,5], 2, 10` → 2. `[7,3,5,5], 1, 10` → −1.

Floating-point ceilings misfire on values like 0.9999…; scaling by speed makes everything integer. Greedily skipping the longest wait is not optimal, because skips shift later rounding.

Time: O(n²)  
Space: O(n)

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
