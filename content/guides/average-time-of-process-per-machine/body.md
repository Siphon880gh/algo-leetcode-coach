## Pair start with end

1. `FROM Activity s JOIN Activity e ON s.machine_id = e.machine_id AND s.process_id = e.process_id`
2. `AND s.activity_type = 'start' AND e.activity_type = 'end'`
3. `SELECT s.machine_id, ROUND(AVG(e.timestamp − s.timestamp), 3) AS processing_time GROUP BY s.machine_id`.

Example → 0.894, 0.995, 1.456.

Conditional aggregation also works: `(SUM(end) − SUM(start)) / COUNT(DISTINCT process_id)`. Do not average raw timestamps.

Time: O(rows)  
Space: O(rows)

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
