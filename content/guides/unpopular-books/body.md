A books table records when each book became available, and an orders table records the quantity and dispatch date of each order. Relative to a fixed reference date, report the books that sold fewer than a small threshold of copies over the past year, excluding books that became available too recently (within about a month). Books with no orders in that period count as 0 copies. The statement gives the exact dates and threshold. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Filter orders in the join, not after it

Using the column names the statement gives:

```sql
-- @year_ago, @month_ago and @min_copies stand for the cutoffs and threshold in the statement.
SELECT b.book_id, b.name
FROM Books b
LEFT JOIN Orders o
  ON o.book_id = b.book_id
 AND o.dispatch_date > @year_ago
WHERE b.available_from < @month_ago
GROUP BY b.book_id, b.name
HAVING COALESCE(SUM(o.quantity), 0) < @min_copies;
```

The date condition sits in the `ON` clause so books without recent orders still appear, with a null sum that `COALESCE` turns into 0. Check in the statement whether each cutoff is inclusive.

Do not put the dispatch-date filter in `WHERE`; it would drop books that had no recent orders. Do not use an inner join for the same reason.

Time: O(n) with hashing  
Space: O(books)

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
