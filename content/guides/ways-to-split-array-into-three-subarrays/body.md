## Bounds on the second cut

1. Prefix sums `P` (non-decreasing, values ≥ 0).
2. For left end `i = 1 … n − 2`: `L` = first `j > i` with `P[j] ≥ 2·P[i]`; `R` = last `j < n` with `P[j] ≤ (P[i] + P[n]) / 2`.
3. Add `max(0, R − L + 1)`; return mod 1e9+7.

`[1,1,1]` → 1. `[1,2,2,2,5,0]` → 3. `[3,2,1]` → 0. (Random tests agree with brute force.)

Zeros make `P` non-strict, so use left and right bisect carefully. Two pointers moving monotonically give O(n).

Time: O(n log n)  
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
