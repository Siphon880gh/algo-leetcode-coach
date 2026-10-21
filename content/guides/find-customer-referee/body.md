## Three-valued logic

```sql
SELECT name
FROM Customer
WHERE referee_id != 2 OR referee_id IS NULL;
```

In SQL, `NULL != 2` is unknown, and `WHERE` keeps only rows that are true. So customers with no referee need their own `IS NULL` test. `IFNULL(referee_id, 0) != 2` and `NOT (referee_id <=> 2)` (MySQL's null-safe equality) also work.

Do not write `referee_id != 2` alone; it silently drops every customer without a referee. Do not use `= NULL`; it is never true.

Time: O(n)  
Space: O(1) beyond the output

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
