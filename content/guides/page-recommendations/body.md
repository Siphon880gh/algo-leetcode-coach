A friendship table lists pairs of users who are friends (in either column), and a likes table lists which user liked which page. For the user named in the statement, recommend the distinct pages that their friends liked but that they have not liked themselves. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Friends from both sides

Using the column names the statement gives:

```sql
-- @uid stands for the user named in the statement.
SELECT DISTINCT l.page_id AS recommended_page
FROM Likes l
WHERE l.user_id IN (
        SELECT user2_id FROM Friendship WHERE user1_id = @uid
        UNION
        SELECT user1_id FROM Friendship WHERE user2_id = @uid)
  AND l.page_id NOT IN (SELECT page_id FROM Likes WHERE user_id = @uid);
```

Do not read friends from one column only; a friendship can be stored either way round. Do not forget `DISTINCT`; several friends can like the same page.

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
