## One GROUP BY

```sql
SELECT customer_id
FROM customer_transactions
GROUP BY customer_id
HAVING SUM(CASE WHEN transaction_type = 'purchase' THEN 1 ELSE 0 END) >= 3
   AND julianday(MAX(transaction_date)) - julianday(MIN(transaction_date)) >= 30
   AND 1.0 * SUM(CASE WHEN transaction_type = 'refund' THEN 1 ELSE 0 END) / COUNT(*) < 0.2
ORDER BY customer_id;
```

Example (run in SQLite) → 101, 104. In MySQL, use DATEDIFF(MAX(transaction_date), MIN(transaction_date)) for the active days.

Dividing refunds by purchases instead of all transactions: 104 drops out (1 / 5 = 20%).

Time: O(rows)  
Space: O(customers)

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
