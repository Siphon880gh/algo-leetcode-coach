Given an array nums of positive integers (values are small, at most 100), count the triplets of distinct indices (i, j, k), in any order, such that nums[i] + nums[j] + nums[k] is divisible by exactly one of nums[i], nums[j] and nums[k]. For instance, [4,6,7,3,2] → 12; [1,2,2] → 6; [1,1,1] → 0. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Loop over values, not indices

1. `cnt[v]` for every value.
2. For `a ≤ b ≤ c` among present values with exactly one of `a, b, c` dividing `a + b + c`:
3. Add `6·ca·cb·cc` (all different), `3·ca(ca − 1)·cc` (a = b < c), `3·cb(cb − 1)·ca` (a < b = c), or `ca(ca − 1)(ca − 2)` (all equal).

Constructed checks (verified against every ordered index triple on 300 random arrays): the three cases above → 12, 6, 0.

At most about 1.7 · 10^5 value triples are tested, independent of n. With all three equal every value divides the sum, so that case never counts, but keeping it is harmless.

Time: O(n + 100³)  
Space: O(100)

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
