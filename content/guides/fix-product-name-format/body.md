A sales table has product names typed inconsistently (extra spaces, mixed case) and sale dates. Report, per normalised product name and per month, how many sales occurred, with formats and ordering as the statement specifies. For instance, "  LCPhone" and "lcphone " count as the same product. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Clean before grouping

Using the column names the statement gives:

1. `LOWER(TRIM(product_name)) AS product_name`.
2. `DATE_FORMAT(sale_date, '%Y-%m') AS sale_date` (or the dialect's equivalent).
3. `GROUP BY` both, `COUNT(*) AS total`, order as required.

Do not group on the raw name; spacing and case variants would split one product into several rows. Group by the cleaned expressions, not the original columns.

Time: O(rows log rows)  
Space: O(groups)

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
