## Fix one corner

Put the points in a set. For each point `p` and each pair `a`, `b` of other points:

1. `u = a − p`, `v = b − p`. Skip unless `u · v == 0` (right angle at `p`).
2. `q = a + b − p`. If `q` is in the set, the area is `|u| · |v|`; keep the minimum.

Return the minimum, or 0 if none was found.

With n ≤ 50 the O(n³) loop is fast. A faster grouping works by diagonals: two pairs with the same midpoint and the same length are the diagonals of a rectangle.

Do not assume the sides are axis-aligned; that is problem 939. Compare dot products in integers to avoid floating-point error, and only use square roots for the final area.

Time: O(n³)  
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
