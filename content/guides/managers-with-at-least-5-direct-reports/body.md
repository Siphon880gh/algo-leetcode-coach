## Group, filter, join back

```sql
SELECT e.name
FROM Employee AS e
JOIN (
    SELECT managerId
    FROM Employee
    GROUP BY managerId
    HAVING COUNT(*) >= 5
) AS m ON e.id = m.managerId;
```

Each employee row with a `managerId` is one direct report. Grouping by `managerId` counts the reports, `HAVING` keeps the groups of 5 or more, and the join turns manager ids into names. `WHERE id IN (subquery)` gives the same result.

Do not group by name, because two employees can share a name. Do not count indirect reports; only rows whose `managerId` is that manager count.

Time: O(n) with hashing  
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
