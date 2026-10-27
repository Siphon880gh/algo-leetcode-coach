Sorted `nums` (length 1 to 1e5, odd) where every value appears exactly twice except one. Return that single value in O(log n) time and O(1) space. `[1,1,2,3,3,4,4,8,8]` → 2. `[3,3,7,7,10,11,11]` → 10.

## Pairs shift after the single element

Left of the single element, each pair sits at `(even, odd)` indexes. The single element breaks this, so right of it every pair sits at `(odd, even)`.

Binary search on `lo = 0`, `hi = n − 1`. Make `mid` even (subtract 1 if odd). If `nums[mid] == nums[mid + 1]`, the pairing is still intact up to `mid + 1`, so the single is to the right: `lo = mid + 2`. Otherwise it is at `mid` or left: `hi = mid`. When `lo == hi`, return `nums[lo]`.

Shortcut: compare `nums[mid]` with `nums[mid ^ 1]` (the partner index) for any `mid`.

XOR of everything finds it in O(n), but the problem asks for O(log n).

Do not let `mid` be odd with the `mid + 1` test — the partner of an odd index is `mid − 1`. Do not set `hi = mid − 1`; `mid` itself may be the answer.

Time: O(log n)  
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
