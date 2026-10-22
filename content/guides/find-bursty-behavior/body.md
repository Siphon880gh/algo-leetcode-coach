A table lists posts with a user and a date. Within the period the statement gives, report the users whose busiest window of consecutive days (of the length the statement gives) holds at least a stated multiple of their average posts per such window over the period. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Self-join windows

This assumes windows start on a post’s day and the average is total posts divided by the number of windows in the period; check the official statement.

Using the column names the statement gives:

1. p = posts in the period.
2. For each post a: cnt = posts b of the same user with 0 ≤ b.date − a.date < window length.
3. Keep users whose `MAX(cnt)` ≥ multiple · (posts / windows in the period).

Constructed check (run in SQLite, February 2024, 7-day windows, 4 weeks, multiple 2): user 1 posts on 1–4 and 20 Feb (busiest 4, average 1.25); user 2 weekly (busiest 1); user 3 on 10 and 12 Feb plus two January posts (busiest 2, average 0.5) → users 1 and 3.

Use < window length: ≤ 7 makes the window 8 days long and adds user 2, whose weekly posts then pair up.

Time: O(n²) worst case  
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
