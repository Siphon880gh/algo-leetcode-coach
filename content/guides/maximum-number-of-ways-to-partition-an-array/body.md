## Who sees the change

1. `diff[p] = pre[p − 1] − (total − pre[p − 1])` for pivots `p = 1 … n − 1`.
2. `right` = counter of all diffs, `left` = empty; `best = right[0]` (no change).
3. For `i` from 0: `d = k − nums[i]`; pivots `p > i` (i in the prefix) need `diff = −d`; pivots `p ≤ i` need `diff = d`. `best = max(best, left[d] + right[−d])`. Then move pivot `i + 1` from `right` to `left`.

Examples → 1, 2, 4. Checked against trying every change on random arrays.

Moving one pivot per step keeps both counters exact, so each change is evaluated in O(1). Use 64-bit sums (n up to 10^5, values up to 10^5).

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
