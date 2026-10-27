You are given an integer array candies, where candies[i] is the flavor of the i-th candy, and an integer k. You must give k consecutive candies to your sister and keep the rest. Return the maximum number of unique flavors you can keep. For instance, [1,2,2,3,4,3] with k = 3 → 3; [2,2,2,2,3,3] with k = 2 → 2; [2,4,5] with k = 0 → 3. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Count what you keep

1. `out` = counter of `candies[k …]`; `best = |out|`.
2. For `i = k … n − 1`: remove `candies[i]` from `out` (it enters the window), add `candies[i − k]` (it leaves); `best = max(best, |out|)`.

Constructed checks (verified against trying every window on random arrays): the three cases above → 3, 2, 3.

Deleting keys that drop to 0 keeps `|out|` equal to the number of distinct flavors you keep. `k = 0` keeps everything.

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
