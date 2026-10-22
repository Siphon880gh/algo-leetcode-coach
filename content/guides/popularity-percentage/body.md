A friends table lists friendships as pairs of users, each pair once. For every user, report their popularity: the percentage of all users on the platform who are their friends, rounded and ordered as the statement says. Who counts as a user on the platform and the exact columns and output names are in the official statement. For instance, with friendships 1–2, 1–3 and 2–4 among four users, user 1 → 50.00 and user 3 → 25.00. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Both directions

Using the column names the statement gives:

1. `UNION ALL` the pairs as (a, b) and (b, a).
2. Total users = `COUNT(DISTINCT` first column) over that union.
3. Per user: `ROUND(100.0 · COUNT(*) / total, 2)`.

Constructed check (run in SQLite): friendships 1–2, 1–3, 2–4 → 50.0, 50.0, 25.0, 25.0 for users 1–4.

Counting only the first column of each pair drops users who appear only second: users 3 and 4 vanish and user 2 drops to 25.0.

Time: O(n log n)  
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
