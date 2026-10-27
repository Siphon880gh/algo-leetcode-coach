A listens table records which user listened to which song on which day; a friendship table lists pairs of friends. Report the friend pairs (as stored in the friendship table) who listened to at least three of the same songs on the same day, as the statement specifies, using the column names it gives. For instance, with friends 1–2, 1–4 and 3–5: if 1 and 2 hear songs 10, 11, 12 on one day, 4 shares only two of them, and 3 and 5 hear the same three songs on different days, only (1, 2) is reported. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## From friendships outward

Using the column names the statement gives:

1. Friendship `f` join listens `a` on `f.user1`, listens `b` on `f.user2`, same song and same day.
2. `GROUP BY` the pair and day; `HAVING COUNT(DISTINCT song) ≥ 3`.
3. `SELECT DISTINCT` the pair.

Constructed check (run in SQLite, the example above): only (1, 2).

Starting from friendships keeps the join small compared with pairing every two listeners. Group by day, or songs spread across days would wrongly count.

Time: O(F · L) worst case  
Space: O(F)

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
