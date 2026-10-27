## Swap-remove without storing the array

Number the cells `0..m·n − 1` (`idx = i · n + j`). Keep `total` = count of zeros and a map that says "position `p` currently holds cell `map[p]`"; a missing key means `p` holds itself.

`flip()`: draw `r` uniform in `[0, total − 1]`. The chosen cell is `map.get(r, r)`. Move the last live cell into slot `r`: `map[r] = map.get(total − 1, total − 1)`, then `total −= 1`. Return `[cell // n, cell % n]`.

This is Fisher-Yates on a virtual array: each live cell is equally likely, one random call per flip, and the map grows by at most one entry per flip.

`reset()`: clear the map and set `total = m · n`.

Do not keep a real array of 1e8 cells. Do not redraw until you hit a zero — that slows down as cells fill and wastes random calls.

Time: O(1) per flip, O(flips) per reset (to clear the map)  
Space: O(flips)

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
