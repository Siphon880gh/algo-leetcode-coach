A student table gives each student's name and continent, with three continents in the data. Pivot it so each continent becomes a column of its students' names in alphabetical order, one name per row, with nulls where a continent runs out. The statement guarantees which continent has the most students. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Row number is the row key

Using the column names the statement gives:

```sql
WITH t AS (
    SELECT name, continent,
        ROW_NUMBER() OVER (PARTITION BY continent ORDER BY name) AS rn
    FROM Student
)
SELECT
    MAX(CASE WHEN continent = 'America' THEN name END) AS America,
    MAX(CASE WHEN continent = 'Asia' THEN name END) AS Asia,
    MAX(CASE WHEN continent = 'Europe' THEN name END) AS Europe
FROM t
GROUP BY rn
ORDER BY rn;
```

`rn` says which output row a name belongs to: the first name of every continent goes on row 1, and so on. Each group has at most one name per continent, so `MAX` simply picks it (or `NULL`).

Do not group by `name`; every student would get a separate row. Do not sort the names after pivoting; the alphabetical order has to be fixed before the pivot, by the `ORDER BY` in the window.

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
