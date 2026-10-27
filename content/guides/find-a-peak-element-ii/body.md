## Row maxima climb

1. `lo = 0`, `hi = m − 1`.
2. `mid`; `j` = column of the max in row `mid`.
3. If `mat[mid][j] < mat[mid + 1][j]`, `lo = mid + 1`; else `hi = mid`.
4. Return `[lo, argmax of row lo]`.

Example 1 → `[0,1]`. Example 2 → `[1,1]` (any peak is accepted; `[2,2]` also qualifies). Checked on random grids that the result is always a peak.

The row max beats its left and right neighbours; moving toward a larger vertical neighbour can only reach larger row maxima, so the walk cannot cycle. Each step costs O(n).

Time: O(n log m)  
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
