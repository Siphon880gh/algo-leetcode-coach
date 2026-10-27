A listens table records which user listened to which song on which day; a friendship table lists pairs of friends (each pair stored once). Recommend user x to user y when they are not friends and both listened to at least three of the same songs on the same day, as the statement specifies. Recommendations go both ways (x to y and y to x); report each distinct pair with the column names the statement gives. For instance, if users 1, 2 and 3 all hear songs 10, 11, 12 on one day, user 4 shares only two of them, and users 1 and 2 are friends, the result is (1, 3), (2, 3), (3, 1), (3, 2). _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Pair up listens

Using the column names the statement gives:

1. `a JOIN b ON same song AND same day AND a.user <> b.user`.
2. Exclude friend pairs in both directions (`NOT EXISTS` over the friendship table).
3. `GROUP BY a.user, b.user, day HAVING COUNT(DISTINCT song) ≥ 3`.
4. `SELECT DISTINCT a.user, b.user`.

Constructed check (run in SQLite, the example above, plus a user hearing the same three songs on a different day): (1, 3), (2, 3), (3, 1), (3, 2).

Group by day too; songs spread over different days do not count. `DISTINCT` on songs guards against repeated listens.

Time: O(L²) worst case on the self-join  
Space: O(L)

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
