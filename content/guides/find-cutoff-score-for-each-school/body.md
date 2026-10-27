A schools table gives each school's capacity; an exam table gives, for some scores, the number of students who scored at least that score. For each school, choose the minimum score whose student count does not exceed the school's capacity (further tie rules as the statement specifies), or −1 if no score qualifies. Use the column names the statement gives. For instance, with exam rows (975, 10), (966, 60), (844, 76), (749, 76), (744, 100): capacity 151 → 744, 48 → 975, 9 → −1, 99 → 749. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Lowest admissible cutoff

Using the column names the statement gives:

`SELECT school, COALESCE((SELECT MIN(score) FROM exam WHERE student_count <= capacity), −1) FROM schools`.

Constructed check (run in SQLite, the example above): 744, 975, −1, 749.

Lower scores admit more students, so the smallest score that still fits capacity is best. A `LEFT JOIN … GROUP BY school` with `IFNULL(MIN(score), −1)` is equivalent.

Time: O(S · E)  
Space: O(1)

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
