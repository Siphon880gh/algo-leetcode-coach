A candidates table lists each candidate's id, experience (Senior or Junior) and salary, and the company has a fixed hiring budget given in the statement. Hire seniors first, cheapest first, as long as the running total stays within the budget; then hire juniors, cheapest first, with what remains. Report the number of accepted seniors and juniors, one row each, as the statement specifies. For instance, with a made-up budget of 100, seniors earning 30, 40, 50 and juniors earning 10, 20, 40: seniors 2 (spending 70) and juniors 2. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Seniors first, then the remainder

Using the column names the statement gives:

1. `s` = seniors with `SUM(salary) OVER (ORDER BY salary, id)` as the running cost.
2. Hired seniors = rows of `s` with running cost ≤ budget; `spent` = their largest running cost (0 if none).
3. `j` = juniors with the same running sum; hired juniors = rows with running cost ≤ budget − `spent`.
4. Output one row per level with its count (0 when none).

Constructed check (run in SQLite, the example above): Senior 2, Junior 2.

Ordering by salary with an id tiebreak keeps the running sum deterministic. Salaries are sorted ascending, so once one senior does not fit, no later (more expensive) senior fits either; the running-sum filter is the same as hiring greedily.

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
