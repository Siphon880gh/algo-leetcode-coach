A relations table lists (user, follower) pairs. For every pair of users, count the followers they have in common; report the pairs (smaller user id first, as the statement specifies) whose count equals the maximum over all pairs, using the column names it gives. For instance, if users 1 and 7 are both followed by 3, 4 and 5, while user 2 is followed by 3, 4 and 6, the pair (1, 7) has 3 common followers and is the only one reported. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Count, then keep the top

Using the column names the statement gives:

1. `p` = `a JOIN b ON same follower AND a.user < b.user`, `GROUP BY` the pair, `COUNT(*)`.
2. Keep rows of `p` with the count equal to `MAX(count)` (or `RANK() … = 1`).

Constructed check (run in SQLite, the example above): only (1, 7, 3); (1, 2) and (2, 7) share 2.

`a.user < b.user` removes self-pairs and duplicates in one condition. Ties at the maximum are all reported.

Time: O(R²) worst case on the self-join  
Space: O(pairs)

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
