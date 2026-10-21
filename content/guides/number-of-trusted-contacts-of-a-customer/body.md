Customers have names and emails, each customer has a list of contacts (each with a name and email), and invoices record a price and the customer. For each invoice, report the customer's name, the price, the number of their contacts, and how many of those contacts are themselves customers (matched by email), ordered as the statement specifies (typically by invoice id). _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Two counts in one pass

Using the column names the statement gives:

```sql
SELECT i.invoice_id, cu.customer_name, i.price,
       COUNT(co.contact_email) AS contacts_cnt,
       COUNT(t.email) AS trusted_contacts_cnt
FROM Invoices i
JOIN Customers cu ON cu.customer_id = i.user_id
LEFT JOIN Contacts co ON co.user_id = cu.customer_id
LEFT JOIN Customers t ON t.email = co.contact_email
GROUP BY i.invoice_id, cu.customer_name, i.price
ORDER BY i.invoice_id;
```

For instance, a customer with three contacts, two of whom are customers, gives `3` and `2` on each of their invoices.

Do not inner-join contacts; customers without contacts would lose their invoices. Do not count `*`; an unmatched LEFT JOIN row would count as 1.

Time: O(n log n)  
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
