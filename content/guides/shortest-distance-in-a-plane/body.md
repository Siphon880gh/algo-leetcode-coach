A table holds distinct points in the plane. Return the shortest Euclidean distance between any two of them, rounded as the statement specifies. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## All pairs, smallest distance

Using the column names the statement gives:

```sql
SELECT ROUND(MIN(SQRT(POW(a.x - b.x, 2) + POW(a.y - b.y, 2))), 2) AS shortest
FROM Point2D AS a
JOIN Point2D AS b
  ON (a.x, a.y) < (b.x, b.y);
```

The row comparison `(a.x, a.y) < (b.x, b.y)` keeps each unordered pair once and never pairs a point with itself. `a.x != b.x OR a.y != b.y` also works, with each pair counted twice.

Do not join on `a.x != b.x AND a.y != b.y`; that skips points that share one coordinate, such as (−1, −1) and (−1, −2). Do not round before taking the minimum.

Time: O(n²) pairs  
Space: O(1) beyond the join

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
