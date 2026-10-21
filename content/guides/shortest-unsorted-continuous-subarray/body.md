## Where the order breaks

**Sort and compare:** sort a copy, then the answer runs from the first index where the two differ to the last one. That is O(n log n).

**One pass each way, O(n):**

1. Left to right, keep `mx`, the max so far. If `nums[i] < mx`, then `i` must be inside the window: set `r = i`.
2. Right to left, keep `mn`, the min so far. If `nums[i] > mn`, set `l = i`.
3. If no `r` was found, the array is sorted: return 0. Otherwise return `r − l + 1`.

An element smaller than something to its left is out of place, so the last such element is the right end. The left end mirrors that.

Do not only look for the first descent and the last descent; values outside them can still need to move, as in `[1,3,2,0]` where the whole array must be sorted. Do not return −1 for a sorted array; the answer is 0.

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
