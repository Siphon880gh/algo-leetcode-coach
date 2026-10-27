## Take the minimum

1. For each `i`, `j`: `x = min(r[i], c[j])`; `m[i][j] = x`; `r[i] −= x`; `c[j] −= x`.
2. Return `m`.

`[3,8]`, `[4,7]` → `[[3,0],[1,7]]`. `[5,7,10]`, `[8,6,8]` → `[[5,0,0],[3,4,0],[0,2,8]]` (one valid answer; the statement's differs).

Each step zeroes a row or a column, and equal totals guarantee all sums reach 0. Do not try to match the sample answer exactly.

Time: O(m · n)  
Space: O(m · n) for the output

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
