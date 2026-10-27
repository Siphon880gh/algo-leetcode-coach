A candidate table lists candidates, and a vote table has one row per vote naming a candidate. Return the name of the candidate with the most votes; the winner is unique. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Top group, then the name

Using the column names the statement gives:

```sql
SELECT c.name
FROM Candidate AS c
JOIN (
    SELECT candidateId
    FROM Vote
    GROUP BY candidateId
    ORDER BY COUNT(*) DESC
    LIMIT 1
) AS w ON c.id = w.candidateId;
```

Count inside `Vote` first, so the join touches one row. `RANK() OVER (ORDER BY COUNT(*) DESC)` would return every tied winner if ties were possible.

Do not join first and group by `name`, because two candidates can share a name. Do not use `MAX(COUNT(*))` in the same `SELECT`; nested aggregates are not allowed.

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
