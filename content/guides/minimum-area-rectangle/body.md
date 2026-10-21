## Two corners fix the other two

1. Store each point as a tuple (or `x · 40001 + y`) in a set.
2. For each pair `(x1, y1)`, `(x2, y2)` with `x1 != x2` and `y1 != y2`:
   - If `(x1, y2)` and `(x2, y1)` are both in the set, update `best = min(best, |x1 − x2| · |y1 − y2|)`.
3. Return `best`, or 0 if none was found.

Each rectangle is found twice (once per diagonal), which is harmless.

A faster alternative groups points by column and remembers, for each pair of y-values, the last x where both appeared.

Do not try all quadruples of points; that is O(n⁴). Do not accept pairs on the same row or column; they cannot be diagonals.

Time: O(n²)  
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
