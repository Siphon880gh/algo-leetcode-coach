A contests table lists, per contest, the user ids of the gold, silver and bronze medallists; a users table gives each user's name and mail. Report the users who either won a medal of any kind in at least three consecutive contests, or won gold in at least three contests (not necessarily consecutive), with the columns the statement specifies. For instance, a user with bronze, gold, silver in contests 190, 191, 192 qualifies; so does one with golds in 190, 193 and 196; one with medals only in 192 and 193 does not. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Two routes to qualify

Using the column names the statement gives:

1. `m` = `UNION ALL` of (contest, gold user), (contest, silver user), (contest, bronze user).
2. Consecutive: `m a JOIN m b ON b.user = a.user AND b.contest = a.contest + 1 JOIN m c ON c.user = a.user AND c.contest = a.contest + 2`.
3. Gold: `GROUP BY` the gold column `HAVING COUNT(*) ≥ 3`.
4. Users whose id is in either set.

Constructed check (run in SQLite, seven contests 190–196): the two qualifying patterns above are reported, a user with medals in only two consecutive contests is not, and a user with two golds is not.

The `+ 1` joins assume contest ids are consecutive integers; if they might have gaps, number the contests with `ROW_NUMBER()` first. A user who qualifies both ways must appear once.

Time: O(medal rows) with indexes  
Space: O(medal rows)

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
