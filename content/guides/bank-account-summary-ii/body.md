## Aggregate then filter

1. `FROM Users u JOIN Transactions t ON u.account = t.account`.
2. `GROUP BY u.account, u.name`.
3. `HAVING SUM(t.amount) > 10000`; select `name`, `SUM(amount) AS balance`.

In the example only Alice qualifies: 7000 + 7000 − 3000 = 11000.

Do not filter in WHERE; the condition is on the sum. Do not group by name alone; names may repeat.

Time: O(rows)  
Space: O(accounts)

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
