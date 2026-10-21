A table gives each distinct number with how many times it occurs. Return the median of the list you would get by repeating every number by its frequency, rounded as the statement specifies. For example, numbers 0, 1, 2, 3 with frequencies 7, 1, 3, 1 expand to twelve values whose two middle values are both 0, so the median is 0. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Both running sums reach half

Using the column names the statement gives:

```sql
WITH t AS (
    SELECT num,
        SUM(frequency) OVER (ORDER BY num) AS up,
        SUM(frequency) OVER (ORDER BY num DESC) AS down,
        SUM(frequency) OVER () AS total
    FROM Numbers
)
SELECT ROUND(AVG(num), 1) AS median
FROM t
WHERE up >= total / 2 AND down >= total / 2;
```

`up` counts the values `≤ num` and `down` counts the values `≥ num`. The median position sits inside `num`'s block exactly when both are at least half the total. With an odd total that is one `num`. With an even total the two middle values can come from two blocks, and `AVG` averages them.

Do not expand the rows into the full list, since frequencies can be large. Do not use integer division for `total / 2`; MySQL `/` already returns a decimal.

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
