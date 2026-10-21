One table logs friend requests (sender, receiver, date) and another logs accepted requests (requester, accepter, date); both may contain duplicates. Return the overall acceptance rate: distinct accepted pairs divided by distinct requested pairs, rounded as the statement specifies, or 0 when there are no requests. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Two distinct counts

Using the column names the statement gives:

```sql
SELECT ROUND(
    IFNULL(
        (SELECT COUNT(DISTINCT requester_id, accepter_id) FROM RequestAccepted)
        / (SELECT COUNT(DISTINCT sender_id, send_to_id) FROM FriendRequest),
        0),
    2) AS accept_rate;
```

Repeated requests or acceptances between the same two people count once, which is why both counts are over distinct pairs. Dividing by 0 gives `NULL` in MySQL, and `IFNULL` turns that into 0.

Do not join the two tables and count matches; the problem defines the rate as two independent counts, even if an acceptance has no matching request. Do not count rows; duplicates would distort the rate.

Time: O(n)  
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
