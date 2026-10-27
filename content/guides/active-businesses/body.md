An events table records, for each business and event type, how many times that event occurred. For each event type, take its average occurrence count across the businesses that have it. A business is active when more than one of its event types is above that type's average. Report the active businesses. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Average per type, then count per business

Using the column names the statement gives:

```sql
WITH type_avg AS (
    SELECT event_type, AVG(occurences) AS avg_occ
    FROM Events
    GROUP BY event_type
)
SELECT e.business_id
FROM Events e
JOIN type_avg t ON e.event_type = t.event_type
WHERE e.occurences > t.avg_occ
GROUP BY e.business_id
HAVING COUNT(*) > 1;
```

A window function works too: `AVG(occurences) OVER (PARTITION BY event_type)` in a subquery, then the same filter and grouping.

Do not compare with the average over all events; each type has its own average. Do not use `≥`; the count must be strictly greater than the average.

Time: O(n) with hashing  
Space: O(event types + businesses)

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
