## Peak = LIS meets LDS

1. `L[i]` = LIS length ending at `i`; `R[i]` = LIS length ending at `i` computed from the right.
2. For peaks with `L[i] > 1` and `R[i] > 1`: keep `L[i] + R[i] − 1`.
3. Return `n −` that maximum.

`[1,3,1]` → 0. `[2,1,1,5,6,2,3,1]` → 3.

Do not accept a peak at an end (L or R equal to 1). O(n²) is fine for n ≤ 1000; patience sorting gives O(n log n).

Time: O(n²)  
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
