## Two counts per row

```sql
WITH t AS (
    SELECT tiv_2016,
        COUNT(*) OVER (PARTITION BY tiv_2015) AS same_2015,
        COUNT(*) OVER (PARTITION BY lat, lon) AS same_place
    FROM Insurance
)
SELECT ROUND(SUM(tiv_2016), 2) AS tiv_2016
FROM t
WHERE same_2015 > 1 AND same_place = 1;
```

Each condition is a group size: shared `tiv_2015` means a partition with more than one row, and a unique location means a `(lat, lon)` partition of exactly one. Window counts keep every row available for the final sum. `tiv_2015 IN (SELECT … HAVING COUNT(*) > 1)` together with `(lat, lon) IN (SELECT … HAVING COUNT(*) = 1)` gives the same answer.

Do not group by `pid`; each policy is its own group and every count would be 1. Do not partition the location by `lat` and `lon` separately; the city is the pair.

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
