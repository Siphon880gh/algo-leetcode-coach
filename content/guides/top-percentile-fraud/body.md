A table lists insurance policies with a state and a fraud score. For each state, report the policies whose score is in the top percentile the statement gives, that is, among the highest-scoring policies of that state. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Window rank per state

Using the column names the statement gives:

1. `PERCENT_RANK() OVER (PARTITION BY state ORDER BY fraud_score DESC)` as pr.
2. Keep rows with pr within the statement’s cutoff, ordered as asked.

This assumes the cutoff is measured with this rank; how ties and the boundary count is set by the official statement.

Constructed check (run in SQLite, cutoff 0.1): ten CA policies with top scores 0.94 and 0.92, and four NY policies with top 0.9 → CA’s 0.94 and NY’s 0.9.

Rank within each state: one ranking over all rows keeps CA’s 0.94 and 0.92 and drops NY entirely.

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
