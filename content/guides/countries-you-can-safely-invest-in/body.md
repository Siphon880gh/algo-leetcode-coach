A person table gives phone numbers whose prefix encodes a country code, a country table maps codes to names, and a calls table records caller, callee, and duration. Report countries whose average call duration (counting each call for both participants' countries) is strictly greater than the global average, as the statement specifies. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Count each call twice

Using the column names the statement gives:

1. `UNION ALL` of `(caller_id, duration)` and `(callee_id, duration)`.
2. Join to persons, then to countries on the code prefix (e.g. `LEFT(phone, 3)`, as the statement formats it).
3. `GROUP BY country HAVING AVG(duration) > (SELECT AVG(duration) FROM Calls)`.

For instance, a country whose people averaged 60 against a global 50 qualifies.

Do not use `UNION` (it deduplicates equal rows). Do not join calls with `OR` on caller/callee, which can miss or double count calls inside one country.

Time: O(rows)  
Space: O(rows)

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
