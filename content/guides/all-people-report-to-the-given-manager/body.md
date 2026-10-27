An employees table gives each employee's direct manager, and the company head is listed as their own manager. Report every employee (other than the head) who reports to the head directly or indirectly, where the chain is at most a few levels deep (three in the usual version; the statement gives the limit). _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Chained self-joins

Using the column names the statement gives:

```sql
-- @head is the head's id from the statement; add or remove joins to match its depth limit.
SELECT e1.employee_id
FROM Employees e1
JOIN Employees e2 ON e1.manager_id = e2.employee_id
JOIN Employees e3 ON e2.manager_id = e3.employee_id
WHERE e3.manager_id = @head
  AND e1.employee_id <> @head;
```

Because the head manages themselves, the chain of joins stays at the head once it gets there, so shorter chains still match.

Do not stop after one join; indirect reports are needed. Do not forget to exclude the head. A recursive CTE handles any depth if the limit is not fixed.

Time: O(n) with indexed joins  
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
