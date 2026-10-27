A submissions table holds both posts and comments: a post has no parent, and a comment points to the post it replies to. Rows may repeat. Report every post with the number of distinct comments on it (0 if none), ordered by post id. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Posts left join comments

Using the column names the statement gives:

```sql
SELECT p.sub_id AS post_id,
       COUNT(DISTINCT c.sub_id) AS number_of_comments
FROM (SELECT DISTINCT sub_id FROM Submissions WHERE parent_id IS NULL) p
LEFT JOIN Submissions c ON c.parent_id = p.sub_id
GROUP BY p.sub_id
ORDER BY post_id;
```

Do not count rows; duplicates must be counted once. Do not start from comments; posts without comments must appear with 0, and comments on missing posts must not appear.

Time: O(n log n)  
Space: O(n)

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
