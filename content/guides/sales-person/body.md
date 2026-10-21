## Anti-join

```sql
SELECT s.name
FROM SalesPerson AS s
WHERE s.sales_id NOT IN (
    SELECT o.sales_id
    FROM Orders AS o
    JOIN Company AS c ON o.com_id = c.com_id
    WHERE c.name = 'RED'
);
```

The subquery lists everyone who touched RED. Everyone else qualifies, including salespeople with no orders at all, and those are exactly the ones an inner join would miss. `NOT EXISTS` or a `LEFT JOIN … WHERE … IS NULL` against that list works the same way.

Do not filter `Orders` with `c.name != 'RED'` and return those names; a person who sold to RED and to another company would still appear. Do not let the subquery return `NULL` ids; `NOT IN` with a `NULL` matches nothing (here `sales_id` is never null).

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
