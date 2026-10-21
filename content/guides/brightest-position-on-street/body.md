Each street lamp is [position, range] and lights every integer from position − range to position + range inclusive. The brightness of a position is the number of lamps lighting it. Return the brightest position; if several tie, return the smallest. For instance, [[-3,2],[1,2],[3,3]] → −1, [[1,0],[0,1]] → 1, [[1,2]] → −1. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Events, not cells

1. `d[p − r] += 1`, `d[p + r + 1] −= 1`.
2. Sorted keys `x`: `cur += d[x]`; if `cur > best`, `best = cur`, `pos = x`.
3. Return `pos`.

Constructed checks (verified against counting every position on random inputs): the three cases above → −1, 1, −1.

The maximum always starts at an event key, so only keys need checking. Strict `>` keeps the smallest tied position. Positions and ranges can be large, so an array indexed by position is impractical.

Time: O(n log n)  
Space: O(n)

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
