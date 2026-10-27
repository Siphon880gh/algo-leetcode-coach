## Lay the weights on a number line

Prefix sums `s[i] = w[0] + … + w[i]` split `[1, total]` into consecutive blocks; block `i` has exactly `w[i]` integers. Draw `x` uniform in `[1, total]` and find the block: the first `i` with `s[i] >= x` (binary search, `bisect_left(s, x)`).

Real-valued version: draw `x` in `[0, total)` and use the first `s[i] > x` (`bisect_right`). Mixing the two conventions makes one index slightly off.

Random Point in Non-overlapping Rectangles (497) uses this to pick a rectangle. The alias method gives O(1) picks after O(n) setup.

Do not build an array with `w[i]` copies of `i` — weights sum to 1e9. Do not draw `x` in `[0, total]` with `bisect_left` — `x = 0` adds an extra chance for index 0.

Time: O(n) setup, O(log n) per pick  
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
