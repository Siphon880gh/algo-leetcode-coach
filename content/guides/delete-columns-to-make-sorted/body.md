## Columns are independent

For each column `j`:

- For `i` from 1 to `n − 1`: if `strs[i][j] < strs[i − 1][j]`, count the column and stop checking it.

Return the count.

Deleting one column never affects whether another column is sorted, so each one is judged on its own. (That changes in Delete Columns II, where rows are compared as whole strings.)

Do not compare whole rows; this problem looks at each column separately. Do not count equal neighbors as unsorted.

Time: O(n · m)  
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
