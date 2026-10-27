## Gaps and islands

```sql
WITH busy AS (
    SELECT *, id - ROW_NUMBER() OVER (ORDER BY id) AS grp
    FROM Stadium
    WHERE people >= 100
),
runs AS (
    SELECT *, COUNT(*) OVER (PARTITION BY grp) AS len
    FROM busy
)
SELECT id, visit_date, people
FROM runs
WHERE len >= 3
ORDER BY visit_date;
```

After filtering, consecutive ids rise by 1 and so does `ROW_NUMBER()`, so their difference stays the same. A gap in the ids changes it. Each `grp` is one run of busy days.

Do not compare only the next two rows with `LEAD`; a row in the middle or at the end of a run must count too (checking previous-two, around and next-two also works, but is longer). Do not use the dates for "consecutive"; the problem defines it by `id`.

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
