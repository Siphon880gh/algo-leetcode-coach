Given an array points where points[i] = [xi, yi] are distinct points on a plane, return the minimum number of straight lines needed so that every point lies on at least one line. The number of points is small. For instance, [[0,1],[2,3],[4,5],[4,3]] → 2; [[0,2],[-2,-2],[1,4]] → 1; a single point → 1. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Always cover the first uncovered point

1. `f(full) = 0`.
2. `i` = lowest point not in `mask`. Options: `1 + f(mask | i)`, and for every `j` not in `mask`, the line through `i` and `j` covers mask `L(i, j)`: `1 + f(mask | L(i, j))`.
3. Return `f(0)`.

Constructed checks (verified against trying every combination of candidate lines on random small sets): the three cases above → 2, 1, 1.

Collinearity uses the cross product `(x2 − x1)(y − y1) = (y2 − y1)(x − x1)` in integers, so no slopes or division. Some line must pass through the first uncovered point, which keeps the branching small.

Time: O(2^n · n²)  
Space: O(2^n)

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
