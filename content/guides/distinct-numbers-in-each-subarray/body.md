Given an array nums and an integer k, return for every window of k consecutive elements the number of distinct values in it. For instance, [1,2,3,2,2,1,3] with k = 3 → [3,2,2,2,3], and [1,1,1,1,2,3,4] with k = 4 → [1,2,3,4]. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Map size per window

1. Count the first `k` elements; record `len(count)`.
2. For `i = k … n − 1`: add `nums[i]`; decrement `nums[i − k]`, deleting it at 0; record `len(count)`.

Constructed checks (verified against `len(set(window))`): the two cases above.

Delete zero-count keys, or the size stays inflated. If values are bounded, an array plus a running distinct counter replaces the map.

Time: O(n)  
Space: O(k)

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
