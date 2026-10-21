## Two passes in place

1. `zeros` = number of 0s in `arr`. Set `i = n − 1` and `j = n − 1 + zeros` (the position in the virtual longer array).
2. While `i ≥ 0`:
   - If `j < n`, write `arr[j] = arr[i]`.
   - If `arr[i] == 0`: `j −= 1`; if `j < n`, write `arr[j] = 0`.
   - `i −= 1`; `j −= 1`.

Writes beyond the end are skipped, and the back-to-front order means every read happens before its slot is overwritten.

Do not insert into the list and pop the end; that is O(n²). Do not shift left to right; you would overwrite values you still need.

Time: O(n)  
Space: O(1)

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
