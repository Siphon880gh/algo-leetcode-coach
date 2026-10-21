A playback table lists sessions with a customer and a start and end time; an ads table lists ads shown to a customer at a timestamp. Report the sessions during which the customer was shown no ad, with the column name the statement specifies. For instance, a session 15–23 for a customer whose only ad was at 5 is ad-free, while a session 17–28 with an ad at 20 for the same customer is not. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Match ads to sessions

Using the column names the statement gives:

1. `FROM` playback `p LEFT JOIN` ads `a ON` same customer `AND a.timestamp BETWEEN p.start AND p.end`.
2. `WHERE a.<ad id> IS NULL`; select the session id.

Constructed check (run in SQLite): sessions (1–5, ad at 5), (15–23, none), (10–12, ad at 17 for that customer), (17–28, ad at 20) → sessions 2 and 3.

Put the time condition in the `ON` clause; in `WHERE` it would turn the left join into an inner join. `BETWEEN` is inclusive; check the statement for how boundary times count. `NOT EXISTS` is an equivalent form.

Time: O(sessions · ads) worst case  
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
