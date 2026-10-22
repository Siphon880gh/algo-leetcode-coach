## Barrier chains

1. If a circle contains (0, 0) or (xCorner, yCorner), return false.
2. Mark circles that touch the left or top side segment, and those that touch the bottom or right side segment.
3. Union two circles that overlap at a point inside the rectangle.
4. Return false if one component has both marks.

Examples → true, false, false, true (checked in code, using x1 r2 + x2 r1 < (r1 + r2) · xCorner and the same for y as the inside test).

Testing the sides as infinite lines: example 4 → false instead of true, since the circle at (5, 5) lies outside the rectangle. Use integer squares: coordinates reach 10^9, so squares need 64-bit.

Time: O(c² α(c))  
Space: O(c)

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
