## Aggregate, then slide

```sql
SELECT visited_on, amount, ROUND(amount / 7, 2) AS average_amount
FROM (
  SELECT visited_on,
         SUM(day_total) OVER (ORDER BY visited_on
                              ROWS BETWEEN 6 PRECEDING AND CURRENT ROW) AS amount,
         ROW_NUMBER() OVER (ORDER BY visited_on) AS rn
  FROM (SELECT visited_on, SUM(amount) AS day_total
        FROM Customer GROUP BY visited_on) d
) w
WHERE rn >= 7
ORDER BY visited_on;
```

The statement guarantees a customer every day, so 7 rows are 7 days.

In the example, 2019-01-07 → 860, 122.86; 2019-01-10 → 1000, 142.86 (two customers on 01-10).

Do not window over raw rows; a busy day would take two slots. Do not output the first six days; their window is incomplete.

Time: O(n log n)  
Space: O(days)

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
