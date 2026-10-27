`points` holds 3 to 1e4 points with coordinates −1e4 to 1e4, joined in order to form a polygon. The polygon is guaranteed simple (edges only meet at shared vertices). Return true if it is convex. `[[0,0],[0,5],[5,5],[5,0]]` → true. `[[0,0],[0,10],[10,10],[10,0],[5,5]]` → false. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Same turn direction at every vertex

For three consecutive points `A`, `B`, `C`, the cross product `(B − A) × (C − A) = (bx − ax)(cy − ay) − (cx − ax)(by − ay)` is positive for a left turn, negative for a right turn, and zero when the points are collinear. Walk `i` from 0 to `n − 1` using indices `i`, `(i + 1) % n`, `(i + 2) % n` so the turns at the last two vertices are included. Keep the sign of the last nonzero cross product. If a new nonzero cross product has the opposite sign, return false. Otherwise return true.

Because the polygon is simple, all turns in one direction means convex. Without that guarantee, a star shape could have all turns the same way and still self-intersect.

Erect the Fence (587) builds a convex hull from scattered points. Valid Boomerang (1037) is a single cross-product check.

Do not treat a zero cross product as a sign change — collinear vertices are allowed. Do not skip the wraparound turns. Products reach about 8e8, which fits in 32 bits, but use 64 bits to be safe.

Time: O(n)  
Space: O(1)

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
