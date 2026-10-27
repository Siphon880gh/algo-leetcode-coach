## Two counts, then join

```sql
WITH t AS (
    SELECT user_id, COUNT(*) AS total
    FROM reactions
    GROUP BY user_id
    HAVING COUNT(*) >= 5
),
c AS (
    SELECT user_id, reaction, COUNT(*) AS cnt
    FROM reactions
    GROUP BY user_id, reaction
)
SELECT c.user_id, c.reaction AS dominant_reaction,
       ROUND(1.0 * c.cnt / t.total, 2) AS reaction_ratio
FROM c
JOIN t ON t.user_id = c.user_id
WHERE c.cnt * 5 >= t.total * 3
ORDER BY reaction_ratio DESC, c.user_id;
```

Example (run in SQLite) → user 3 love 1.0, then user 1 like 0.8. MySQL 8 runs the same query and shows 1.00 and 0.80. The 1.0 * matters in SQLite, where dividing two integers truncates; cnt * 5 ≥ total * 3 keeps the 60% test exact. A share of at least 60% is a strict majority, so each user has at most one dominant reaction.

Using a strict 60% test: a made-up user with 3 sad out of 5 reactions (ratio 0.60) is dropped instead of kept.

Time: O(rows)  
Space: O(rows)

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
