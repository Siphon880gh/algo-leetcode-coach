A candidates table gives each candidate's years of experience and an interview id; a rounds table gives the score of each round of each interview. Report the ids of candidates who have at least the years of experience the statement requires and whose total score over all rounds of their interview is above the threshold it gives. For instance, with sample thresholds of 2 years and a total above 15: a candidate with 3 years and rounds 9 + 8 is accepted, one with 1 year and 10 + 10 is not, and one with 4 years and 7 + 8 is not. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Join, group, HAVING

Using the column names the statement gives:

Using the column names the statement gives, with its experience and score thresholds:

1. `candidates JOIN rounds USING (interview id)`.
2. `WHERE` experience ≥ the required years.
3. `GROUP BY` candidate; `HAVING SUM(score) >` the score threshold.

Constructed check (run in SQLite, the example above): only the first candidate.

The experience filter belongs in `WHERE` (row level), the score total in `HAVING` (group level). Strict versus non-strict comparisons should follow the statement exactly.

Time: O(C + R)  
Space: O(C)

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
