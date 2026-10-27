Given the integer coordinates of trees, return the center x, y and radius r of the smallest circle that encloses all trees (points on the boundary count as inside); answers within a small tolerance are accepted, as the statement specifies. For instance, [[1,1],[2,2],[2,0],[2,4],[3,3],[4,2]] → [2.0, 2.0, 2.0], and [[1,2],[2,2],[4,2]] → [2.5, 2.0, 1.5]. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Incremental minimum circle

1. Shuffle. `c` = circle of the first point (radius 0).
2. For `i`: if `p[i]` is outside, `c` = point circle of `p[i]`; for `j < i` outside, `c` = circle with diameter `p[i]p[j]`; for `k < j` outside, `c` = circumcircle of `p[i], p[j], p[k]`.
3. Return `c`.

Constructed checks (verified against trying every 2- and 3-point circle on random point sets): the two cases above → `(2, 2, 2)` and `(2.5, 2, 1.5)`.

Use a small epsilon in the "inside" test. Random order is what gives the expected O(n); on adversarial order it degrades to O(n³).

Time: O(n) expected  
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
