## Shift, then median

1. `p` = indices of ones; `q[i] = p[i] − i`; prefix sums `P` over `q`.
2. For window `i … i + k − 1`, median index `m = i + k // 2`, value `med = q[m]`.
3. Cost = `med · (m − i) − (P[m] − P[i]) + (P[i + k] − P[m + 1]) − med · (i + k − m − 1)`.
4. Return the minimum.

`[1,0,0,1,0,1]`, 2 → 1. `[1,0,0,0,0,0,1,1]`, 3 → 5. `[1,1,0,1]`, 2 → 0.

The shift removes the "+0, +1, +2 …" offsets of a consecutive block. Without the shift, the median distance counts moves to a single point, not into a consecutive block.

Time: O(n)  
Space: O(n)

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
