## Compare the two edges

Search `lo = 0`, `hi = n − k`. While `lo < hi`:

- `mid = (lo + hi) // 2`.
- If `x − arr[mid] > arr[mid + k] − x`, the window `[mid, mid + k − 1]` is worse than shifting right: `lo = mid + 1`.
- Otherwise `hi = mid`.

Return `arr[lo : lo + k]`. Using the signed differences (not absolute values) handles `x` outside the array and ties: on a tie the left value wins, as the problem asks.

Another route: binary search for `x`, then expand two pointers outward k times. Or shrink from both ends, dropping the farther end until k remain, in O(n − k).

Do not compare `abs(x − arr[mid])` with `abs(arr[mid + k] − x)`; with duplicates it can move the wrong way. Do not sort the result by distance; the output stays in ascending order.

Time: O(log(n − k) + k)  
Space: O(1) beyond the output

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
