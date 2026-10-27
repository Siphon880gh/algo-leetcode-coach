## Fall first, rotate second

1. For each row: `empty = n − 1`; for `j` from `n − 1` down to 0:
   - `*` → `empty = j − 1`;
   - `#` → clear it, put `#` at `empty`, `empty −= 1`.
2. `res[j][i] = box[m − 1 − i][j]` for the n × m result.

All three examples match.

Clear the stone before writing it at `empty`, because `empty` may equal `j`. The clockwise rotation sends row 0 to the last column.

Time: O(m · n)  
Space: O(m · n)

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
