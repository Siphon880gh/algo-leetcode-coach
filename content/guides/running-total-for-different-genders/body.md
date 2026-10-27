A scores table records a player's gender, a day, and the points scored. For each gender and day, report the running total of points for that gender up to and including that day, ordered by gender and day. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Cumulative sum

Using the column names the statement gives:

```sql
SELECT gender, day,
       SUM(score_points) OVER (PARTITION BY gender ORDER BY day) AS total
FROM Scores
ORDER BY gender, day;
```

Without window functions, a self-join sums rows of the same gender with an earlier or equal day:

```sql
SELECT a.gender, a.day, SUM(b.score_points) AS total
FROM Scores a
JOIN Scores b ON b.gender = a.gender AND b.day <= a.day
GROUP BY a.gender, a.day
ORDER BY a.gender, a.day;
```

For instance, one gender scoring 10, 5, 20 on three successive days has totals 10, 15, 35.

Do not partition by player; the total is per gender. Do not forget `ORDER BY day` inside the window; without it every row gets the full total.

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
