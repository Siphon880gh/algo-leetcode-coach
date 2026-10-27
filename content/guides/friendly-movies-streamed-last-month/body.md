A TV program table records what content aired on which channel and when, and a content table describes each content item (title, whether it is kid-friendly, and its type). Report the distinct titles of kid-friendly movies streamed during the month the statement specifies. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Filter then dedupe

Using the column names the statement gives:

1. `JOIN Content c ON p.content_id = c.content_id`.
2. `WHERE` the program date falls in the required month (a half-open date range is safest), the kids flag is set, and the content type is a movie.
3. `SELECT DISTINCT c.title`.

For instance, a kid-friendly movie aired twice that month appears once.

Do not forget DISTINCT; a movie can air on several channels or days. Do not match the month with a bare `LIKE` on a datetime without checking the format.

Time: O(rows)  
Space: O(titles)

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
