An array of equal integers except one larger value is accessible only through a reader that returns its length and compares the sums of two subarrays (larger, equal, or smaller), with a limited number of compare calls as the statement specifies. Return the larger value's index. For instance, in `[7,7,7,7,10,7,7,7]` the answer is 4. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Balance-scale search

1. `l = 0`, `r = n − 1`.
2. While `l < r`: `len = r − l + 1`, `h = len // 2`; compare `[l, l+h−1]` with `[r−h+1, r]`.
3. Left heavier → `r = l + h − 1`. Right heavier → `l = r − h + 1`. Equal → return the middle `l + h` (odd length).
4. Return `l`.

`[7,7,7,7,10,7,7,7]`: halves [0..3] vs [4..7] → right heavier; [4,5] vs [6,7] → left; [4] vs [5] → left → 4.

Do not compare unequal-length halves; sums would mislead. About log₂ n calls fit the budget.

Time: O(log n) calls  
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
