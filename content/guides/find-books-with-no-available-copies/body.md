## Group and compare

```sql
SELECT b.book_id, b.title, b.author, b.genre, b.publication_year,
       COUNT(*) AS current_borrowers
FROM library_books b
JOIN borrowing_records r ON r.book_id = b.book_id
WHERE r.return_date IS NULL
GROUP BY b.book_id, b.title, b.author, b.genre, b.publication_year, b.total_copies
HAVING COUNT(*) = b.total_copies
ORDER BY current_borrowers DESC, b.title;
```

Example (run in SQLite) → The Great Gatsby with 3, 1984 with 1. total_copies is in GROUP BY so MySQL accepts it in HAVING.

Writing return_date = NULL instead of IS NULL: no rows, because a comparison with NULL is never true.

Time: O(records)  
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
