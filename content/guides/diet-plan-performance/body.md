Given daily calories, a window length `k`, and bounds `lower` and `upper`, look at every run of `k` consecutive days. A total below `lower` loses a point, above `upper` gains a point, and otherwise scores nothing. Return the final score. For instance, `[1,2,3,4,5]` with `k = 1`, `lower = upper = 3` scores −1 − 1 + 0 + 1 + 1 = 0. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Fixed window

1. `s = sum(calories[:k])`, `score = 0`.
2. For each window start `i` from 0 to `n − k`: score `s`, then if `i + k < n`, `s += calories[i + k] − calories[i]`.
3. Scoring: `s < lower` → −1, `s > upper` → +1.

Do not recompute each window sum; that is O(n · k). Do not score at the bounds; equal to `lower` or `upper` scores 0.

Time: O(n)  
Space: O(1)

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
