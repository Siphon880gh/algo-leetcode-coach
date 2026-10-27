## Rows become columns

For an `m × n` input:

1. Create `res` with `n` rows and `m` columns.
2. For every `i < m`, `j < n`: `res[j][i] = matrix[i][j]`.

Return `res`.

In Python, `list(map(list, zip(*matrix)))` does the same.

Do not swap across the diagonal in place; that only works for square matrices. Do not mix up the result shape; it is `n × m`.

Time: O(m · n)  
Space: O(m · n) for the result

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
