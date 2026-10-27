The same hiring setup as part I: a candidates table with each candidate's id, experience (Senior or Junior) and salary, and a fixed budget given in the statement. Hire seniors cheapest first while the running total fits the budget, then juniors cheapest first with the remainder, and report the ids of everyone hired, as the statement specifies. For instance, with a made-up budget of 100, seniors 1 (30), 2 (50), 3 (40) and juniors 4 (10), 5 (20), 6 (40): hired ids 1, 3, 4, 5. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Return rows instead of counts

Using the column names the statement gives:

1. `s` = seniors with `SUM(salary) OVER (ORDER BY salary, id)`; hired seniors = running sum ≤ budget.
2. `spent` = `COALESCE(MAX(running sum), 0)` over hired seniors.
3. `j` = juniors with the same running sum; hired juniors = running sum ≤ budget − `spent`.
4. `UNION ALL` the two id lists.

Constructed check (run in SQLite, the example above): 1, 3, 4, 5.

The `COALESCE` matters when no senior fits: juniors then get the whole budget. Ascending salaries mean the first senior who does not fit ends the senior phase.

Time: O(n log n)  
Space: O(n)

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
