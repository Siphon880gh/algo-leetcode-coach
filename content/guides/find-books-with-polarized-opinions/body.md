## One GROUP BY

```sql
SELECT b.book_id, b.title, b.author, b.genre, b.pages,
       MAX(r.session_rating) - MIN(r.session_rating) AS rating_spread,
       ROUND(1.0 * SUM(CASE WHEN r.session_rating <= 2 OR r.session_rating >= 4 THEN 1 ELSE 0 END) / COUNT(*), 2) AS polarization_score
FROM books b
JOIN reading_sessions r ON r.book_id = b.book_id
GROUP BY b.book_id, b.title, b.author, b.genre, b.pages
HAVING COUNT(*) >= 5
   AND MAX(r.session_rating) >= 4
   AND MIN(r.session_rating) <= 2
   AND 1.0 * SUM(CASE WHEN r.session_rating <= 2 OR r.session_rating >= 4 THEN 1 ELSE 0 END) / COUNT(*) >= 0.6
ORDER BY polarization_score DESC, b.title DESC;
```

Example (run in SQLite) → The Great Gatsby 4, 1.00; 1984 4, 1.00. SQLite prints the score as 1.0; MySQL’s ROUND keeps 1.00. The 1.0 * avoids integer division in SQLite; MySQL’s / already returns a decimal.

Dropping the high-and-low check: To Kill a Mockingbird (all ratings 4 or 5) is added with score 1.00.

Time: O(rows log rows)  
Space: O(books)

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
