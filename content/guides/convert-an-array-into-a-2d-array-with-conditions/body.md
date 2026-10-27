## Copies by row

1. `seen[x]` counts copies of x placed so far; `rows` is empty.
2. For each `x`: if `seen[x]` equals the number of rows, add a new row. Append `x` to `rows[seen[x]]`; `seen[x]++`.
3. Return `rows`.

Examples → [[1,3,4,2],[1,3],[1]], [[1,2,3,4]] (any valid answer is accepted). Checked on 200 random arrays: rows are distinct, every value is used, and the row count equals the highest frequency.

Each row gets at most one copy of each value, so rows stay distinct.

Time: O(n)  
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
