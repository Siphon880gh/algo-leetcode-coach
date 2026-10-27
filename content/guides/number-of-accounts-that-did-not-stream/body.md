A subscriptions table gives each account's subscription start and end dates, and a streams table records streaming sessions with an account and a date. Report how many accounts had a subscription during the year the statement names but had no streaming session in that year. For instance, an account subscribed through that year whose only stream was the year before counts; an account that streamed during the year does not; an account whose subscription ended before the year does not. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Overlap, then anti-join

Using the column names the statement gives:

Using the column names the statement gives, with `Y` the year it names:

1. Active accounts: `start_date ≤ Y-12-31 AND end_date ≥ Y-01-01`.
2. Exclude accounts with any stream whose date falls in `Y` (`NOT IN` or `NOT EXISTS`).
3. `COUNT(*)` the rest.

Constructed check (run in SQLite with six accounts): two qualify; both were subscribed from the previous year into `Y` and streamed only before `Y`.

Testing overlap, not only the start year, keeps subscriptions that began earlier. The stream filter must also be limited to `Y`, or old streams would wrongly exclude accounts.

Time: O(S + T)  
Space: O(T)

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
