A table holds distinct integer positions on a line. Return the smallest distance between any two of them. For instance, points −1, 0, 2 give 1. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Neighbors are enough

Using the column names the statement gives:

```sql
SELECT MIN(x - prev) AS shortest
FROM (
    SELECT x, LAG(x) OVER (ORDER BY x) AS prev
    FROM Point
) AS t;
```

If three points are sorted as `a < b < c`, then `c − a` is larger than both `b − a` and `c − b`. So the closest pair is always adjacent in sorted order. The first row's `prev` is `NULL`, and `MIN` ignores it.

A self-join `MIN(ABS(a.x − b.x))` with `a.x != b.x` is also correct, but it checks O(n²) pairs.

Do not take `MIN(x) − …` or `MAX − MIN`; that is the farthest span, not the closest pair. Do not forget the `ORDER BY` inside the window.

Time: O(n log n)  
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
