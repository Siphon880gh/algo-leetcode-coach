## Fixed window

`s = sum(nums[:k])`, `best = s`. For `i` from `k` to `n − 1`: `s += nums[i] − nums[i − k]`, `best = max(best, s)`. Return `best / k`.

The length is fixed, so the best average is just the best sum; dividing once at the end avoids rounding drift.

Maximum Average Subarray II (644) allows any length of at least `k` and needs binary search on the answer.

Do not recompute each window's sum from scratch; that is O(n · k). Do not start `best` at 0; every value can be negative.

Time: O(n)  
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
