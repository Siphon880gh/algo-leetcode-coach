A friendship table lists pairs of user ids who are friends (each pair stored once, in either column); a likes table lists which user likes which page. For every user, recommend each page liked by at least one friend that the user does not already like, together with how many friends like it. Use the output column names and order the statement specifies. For instance, with friends 1–2, 1–3, 2–3 and likes 1:{10}, 2:{20, 30}, 3:{20}: user 1 gets page 20 (2 friends) and 30 (1); user 2 gets 10 (1); user 3 gets 10 (1) and 30 (1). _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Both directions, anti-join, count

Using the column names the statement gives:

1. `fr` = `(user1, user2)` `UNION ALL` `(user2, user1)`.
2. Join `fr.friend` to likes.
3. Keep rows where the user does not like that page (`NOT EXISTS` on likes, or `LEFT JOIN … IS NULL`).
4. `GROUP BY` user, page; `COUNT(*)` as the friends' likes.

Constructed check (run in SQLite, the example above): (1, 20, 2), (1, 30, 1), (2, 10, 1), (3, 10, 1), (3, 30, 1).

Skipping the reverse direction misses half the recommendations. The anti-join must match on both user and page.

Time: O(F · L) worst case, much less with indexes  
Space: O(F + L)

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
