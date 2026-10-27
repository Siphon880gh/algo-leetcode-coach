## Monotone chain

Let `cross(o, a, b) = (a.x − o.x)(b.y − o.y) − (a.y − o.y)(b.x − o.x)`. It is positive for a left turn, negative for a right turn, and 0 when the points are collinear.

1. Sort the points by `(x, y)`.
2. **Lower hull:** for each point `p`, while the stack has at least two points and `cross(stack[−2], stack[−1], p) < 0`, pop. Then push `p`.
3. **Upper hull:** do the same over the points in reverse order.
4. Join the two hulls and remove duplicates; the endpoints appear in both, and collinear cases can repeat points.

Using `< 0` (not `≤ 0`) keeps the trees that sit exactly on a fence edge, which the problem requires.

Graham scan or Jarvis march also work, but collinear points on the hull are easier to get right with a monotone chain.

Do not pop on `cross == 0`; that drops trees on the fence. Do not skip the duplicate removal; when every point is collinear, both passes return the same points.

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
