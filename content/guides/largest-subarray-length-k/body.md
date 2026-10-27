Given an array of distinct integers and k, return the largest subarray of length k, where subarrays compare by their first differing element. For instance, [1,4,5,2,3] with k = 3 → [5,2,3]. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Only the first element matters

1. `i = argmax(nums[0 .. n − k])`.
2. Return `nums[i : i + k]`.

Constructed check: `[1,4,5,2,3]`: k = 3 → `[5,2,3]`; k = 4 → `[4,5,2,3]`; k = 1 → `[5]`.

Distinctness guarantees the first elements differ. Do not search past index `n − k`; a later start cannot fit k elements.

Time: O(n)  
Space: O(1) extra

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
