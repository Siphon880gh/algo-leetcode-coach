## CASE inside SUM

1. `SELECT transaction_date, SUM(CASE WHEN amount % 2 = 1 THEN amount ELSE 0 END) AS odd_sum, SUM(CASE WHEN amount % 2 = 0 THEN amount ELSE 0 END) AS even_sum FROM transactions GROUP BY transaction_date ORDER BY transaction_date`

Example (run in SQLite) → (2024-07-01, 75, 350), (2024-07-02, 0, 350), (2024-07-03, 0, 120).

Splitting by transaction_id instead: 2024-07-01 → odd 225 instead of 75.

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
