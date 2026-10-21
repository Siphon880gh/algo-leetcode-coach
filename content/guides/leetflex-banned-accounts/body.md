A login log records, per session, an account, an IP address, a login time and a logout time. Report every account that was logged in from two different IP addresses at overlapping times, with the column name the statement specifies. For instance, an account with sessions 10:00–11:00 on one IP and 10:30–12:00 on another is reported; one with 9:00–10:00 and 11:00–12:00 on different IPs is not, and overlapping sessions on the same IP do not count. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Self-join for overlaps

Using the column names the statement gives:

1. Join the log `x` to itself as `y` on the same account and `x.ip <> y.ip`.
2. Keep pairs where `y`'s login falls between `x`'s login and logout (`BETWEEN` is inclusive; check the statement for how touching times count).
3. `SELECT DISTINCT` the account.

Constructed check (run in SQLite): sessions (10–11, IP 1) and (10.5–12, IP 2) → reported; (9–10, IP 1) and (11–12, IP 2) → not; two overlapping sessions on IP 1 → not.

Each overlapping pair appears in at least one join order, so testing one start against the other interval is enough. Do not forget `DISTINCT`; several pairs can flag the same account.

Time: O(rows²) in the worst case  
Space: O(result)

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
