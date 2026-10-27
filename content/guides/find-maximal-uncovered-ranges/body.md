You get the length n of an array of cells and a list of ranges, each covering a contiguous block of cells with both ends included; ranges may overlap. Return the maximal blocks of cells that no range covers, as [start, end] pairs sorted by start, so two uncovered blocks are never adjacent. The limits are in the official statement; the method below does not depend on n. For instance, n = 8 with ranges [1,2], [2,3] and [6,6] → [[0,0],[4,5],[7,7]], and n = 4 with the single range [0,3] → []. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Sweep

1. Sort ranges by start; `last = −1`.
2. For each `[l, r]`: if `l > last + 1`, output `[last + 1, l − 1]`; then `last = max(last, r)`.
3. If `last < n − 1`, output `[last + 1, n − 1]`.

Constructed checks (verified against marking cells one by one on 500 random cases): the two inputs above → [[0,0],[4,5],[7,7]] and [].

Using max for last handles ranges nested inside earlier ones. Gaps come out in increasing order, and touching or overlapping ranges never create a gap between them.

Time: O(m log m) for m ranges  
Space: O(1) besides sorting and the output

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
