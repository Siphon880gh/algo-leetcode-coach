## Full ones from the top

1. `fl` = sorted `min(flowers[i], target)`; prefix sums `pre`.
2. For `j = 0 … n` while `j · target − (sum of the top j) ≤ newFlowers`:
3. With `rem` left and the first `m = n − j` gardens incomplete, binary search the largest `x < target` such that raising every value below `x` costs `x · c − pre[c] ≤ rem` (`c` = how many are below `x`).
4. Score `j · full + x · partial` (just `j · full` when `m = 0`); keep the best.

Examples → 14, 30. Checked against trying every way to place the flowers on 300 small cases.

Gardens already at target count as full for free, which the cap handles. If the m-th garden is already at target, j is too small to be meaningful. Scores reach about 2 · 10^10, so use 64-bit.

Time: O(n log n · log target)  
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
