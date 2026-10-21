## Two LIMIT 1 queries

```sql
(SELECT u.name AS results
 FROM MovieRating r JOIN Users u ON u.user_id = r.user_id
 GROUP BY u.user_id, u.name
 ORDER BY COUNT(*) DESC, u.name
 LIMIT 1)
UNION ALL
(SELECT m.title
 FROM MovieRating r JOIN Movies m ON m.movie_id = r.movie_id
 WHERE r.created_at >= '2020-02-01' AND r.created_at < '2020-03-01'
 GROUP BY m.movie_id, m.title
 ORDER BY AVG(r.rating) DESC, m.title
 LIMIT 1);
```

In the example, Daniel and Monica both rated 3 movies → Daniel; Frozen 2 and Joker both average 3.5 → Frozen 2.

Do not use `UNION`; if a user name equals a movie title, the duplicate would collapse. Do not forget the parentheses; each part needs its own `ORDER BY … LIMIT`.

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
