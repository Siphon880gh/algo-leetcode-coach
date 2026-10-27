## Anti-join

1. `FROM Visits v LEFT JOIN Transactions t ON v.visit_id = t.visit_id`.
2. `WHERE t.transaction_id IS NULL`.
3. `GROUP BY v.customer_id`, `COUNT(*) AS count_no_trans`.

In the example: 54 → 2, 30 → 1, 96 → 1.

Do not join on customer_id; a customer can have visits with and without transactions. `NOT IN` / `NOT EXISTS` on visit_id also works.

Time: O(rows)  
Space: O(customers)

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
