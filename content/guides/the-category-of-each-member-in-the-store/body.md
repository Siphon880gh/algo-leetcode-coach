A members table, a visits table (each visit by a member) and a purchases table (visits that ended in a purchase) describe a store. Each member's conversion rate is 100 · purchases / visits. Report each member with a category: members with no visits get the lowest category, and the others are placed into bands of the conversion rate as the statement specifies. For instance, with sample bands of ≥ 80 (Diamond), ≥ 50 (Gold), otherwise Silver, and Bronze for no visits: 2 visits with 2 purchases → Diamond, 4 with 1 → Silver, 2 with 1 → Gold, no visits → Bronze. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Two left joins and a CASE

Using the column names the statement gives: take the bands from it too.

1. `members LEFT JOIN visits LEFT JOIN purchases` on the member and visit ids.
2. `GROUP BY` member; `v = COUNT(visit id)`, `p = COUNT(purchase visit id)`.
3. `CASE WHEN v = 0 THEN` the no-visit category, then compare `100.0 · p / v` with the bands from highest to lowest.

Constructed check (run in SQLite, the example above): Diamond, Silver, Gold, Bronze.

Left joins keep members with no visits; counting a column from each table ignores the NULLs they produce. Use `100.0` to avoid integer division.

Time: O(M + V + P)  
Space: O(M)

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
