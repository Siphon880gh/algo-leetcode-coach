A transactions table records each transaction's country, state (approved or declined), amount, and date, and a chargebacks table records chargebacks against transactions with their own date. For each month and country, report the number and total amount of approved transactions and of chargebacks, where a chargeback counts in the month it happened. The official statement lists the exact columns and which rows to keep. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Union, then aggregate

Using the column names the statement gives:

```sql
WITH events AS (
  SELECT DATE_FORMAT(trans_date, '%Y-%m') AS month, country,
         'approved' AS kind, amount
  FROM Transactions
  WHERE state = 'approved'
  UNION ALL
  SELECT DATE_FORMAT(c.trans_date, '%Y-%m'), t.country,
         'chargeback', t.amount
  FROM Chargebacks c
  JOIN Transactions t ON t.id = c.trans_id
)
SELECT month, country,
       SUM(kind = 'approved') AS approved_count,
       SUM(CASE WHEN kind = 'approved' THEN amount ELSE 0 END) AS approved_amount,
       SUM(kind = 'chargeback') AS chargeback_count,
       SUM(CASE WHEN kind = 'chargeback' THEN amount ELSE 0 END) AS chargeback_amount
FROM events
GROUP BY month, country;
```

Do not date a chargeback by its original transaction; it belongs to its own month. Do not use `UNION`; it would merge identical event rows. If the statement asks to drop groups with no activity, filter them with `HAVING`.

Time: O(n + c)  
Space: O(groups)

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
