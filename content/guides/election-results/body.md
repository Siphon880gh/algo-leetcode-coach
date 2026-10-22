A votes table records which candidate each voter voted for; a voter may vote for several candidates, and their one vote is split equally among them. Report the candidate or candidates with the most votes, ordered as the statement says. How voters with no candidate are recorded and the output names are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Weighted votes

Using the column names the statement gives:

1. `w = 1.0 / COUNT(*) OVER (PARTITION BY voter)`, skipping rows with no candidate.
2. Sum w per candidate.
3. Keep candidates whose total equals the maximum; order as the statement says.

Constructed check (run in SQLite): v1 votes for A and B, v2 for A, v3 for B and C → A has 1.5, B 1.0, C 0.5, so A wins.

Counting rows ignores the split: the same data → A and B tied at 2. Use 1.0, not 1, so integer division does not round the weights to 0.

Time: O(n log n)  
Space: O(n)

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
