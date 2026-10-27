Given a matrix whose rows are sorted in strictly increasing order, return the smallest value that appears in every row, or −1 if none does. For instance, `[[1,3,6],[2,3,6],[3,6,9]]` gives 3 and `[[1,2],[3,4]]` gives −1. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Count, then scan the first row

1. `cnt[v] += 1` for every value in every row.
2. For `v` in the first row (already increasing): if `cnt[v] == rows`, return `v`.
3. Return −1.

Strictly increasing rows mean a value can add at most 1 per row, so a count equal to the row count means it is in every row.

Binary searching each first-row value in the other rows also works.

Do not reuse this count on rows that can repeat values; count each value once per row there. Do not return the most common value; it must be in all rows.

Time: O(rows · cols)  
Space: O(distinct values)

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
