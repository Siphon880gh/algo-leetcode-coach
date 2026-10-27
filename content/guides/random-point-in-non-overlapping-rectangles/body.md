## Weight by integer points, then sample inside

A rectangle covers `(x − a + 1) · (y − b + 1)` integer points — note the `+ 1`, since both edges count. Build prefix sums `s[i]` of those counts. For a pick, draw `v` uniform in `1..s[last]`, find the first `i` with `s[i] >= v` by binary search, and return a uniform `u` in `[a_i, x_i]` and `v` in `[b_i, y_i]`.

Because each rectangle is chosen with probability proportional to its point count, and then each of its points is equally likely, every point overall has probability `1 / total`.

You can also map `v` straight to a point: the offset `v − s[i − 1] − 1` inside rectangle `i` gives a column and row with `divmod` by the width.

Random Pick with Weight (528) is the same prefix-sum sampling. Generate Random Point in a Circle (478) samples continuous points.

Do not pick a rectangle uniformly — small ones would be oversampled. Do not use area `(x − a)(y − b)` — that undercounts edge points and gives zero for a line-shaped rectangle.

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
