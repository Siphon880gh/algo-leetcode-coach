## Left and right parts

1. Group the indices of each value in increasing order.
2. For a group with total `T`, walk with `left` = sum of earlier indices. For the cth index `i` (0-based) of `m`: `arr[i] = c · i − left + (T − left − i) − (m − c − 1) · i`; then `left += i`.
3. Return `arr`.

Examples → [5,0,3,4,0], [0,0,0]. Checked against summing every pair on 300 random arrays.

When every value is equal, the sum at an end index is about n² / 2, up to 5 · 10^9, so use 64-bit.

Time: O(n)  
Space: O(n)

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
