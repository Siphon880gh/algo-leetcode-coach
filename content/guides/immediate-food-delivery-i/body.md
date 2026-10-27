A delivery table records each order with its order date and the customer's preferred delivery date. An order is immediate when the two dates are equal. Report the percentage of immediate orders among all orders, rounded as the statement specifies. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Average a flag

Using the column names the statement gives:

```sql
SELECT ROUND(100 * AVG(order_date = customer_pref_delivery_date), 2)
       AS immediate_percentage
FROM Delivery;
```

In MySQL a comparison is 1 or 0, so its average is the share of immediate orders.

Do not restrict to first orders; that is the follow-up problem. Do not divide two integer counts in an engine with integer division; multiply by 100.0 first.

Time: O(n)  
Space: O(1)

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
