A follow table lists unique (followee, follower) pairs. A second-degree follower follows at least one user and is followed by at least one user. Report each such user with their number of followers, ordered by user. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Followed, and also a follower

Using the column names the statement gives:

```sql
SELECT followee AS follower, COUNT(*) AS num
FROM Follow
WHERE followee IN (SELECT follower FROM Follow)
GROUP BY followee
ORDER BY followee;
```

Grouping by `followee` counts each user's followers. The `IN` filter keeps only users who also follow someone. Since `(followee, follower)` is unique, `COUNT(*)` counts distinct followers.

Do not count the people they follow; `num` is their own followers. Do not join the table to itself and count rows; each user would be multiplied by the number of people they follow.

Time: O(n) with hashing  
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
