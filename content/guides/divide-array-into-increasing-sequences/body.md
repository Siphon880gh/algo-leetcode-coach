Given a sorted (non-decreasing) array `nums` and an integer `k`, decide whether it can be split into one or more disjoint strictly increasing subsequences, each of length at least `k`. For instance, `[1,2,2,3,3,4,4]` with `k = 3` can be split into `[1,2,3,4]` and `[2,3,4]`, while `[5,6,6,7,8]` with `k = 3` cannot. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Count the busiest value

1. `f` = the largest number of equal values (one pass, since the array is sorted).
2. Return `f · k ≤ n`.

Necessity: equal values cannot share a strictly increasing subsequence, so there are at least `f` subsequences, each with at least `k` items.

Sufficiency: deal the sorted array round-robin into `f` piles; equal values land in different piles, every pile stays increasing, and each pile gets at least `⌊n / f⌋ ≥ k` items.

Do not simulate a greedy split; the counting argument is exact. Do not use a hash map; the sorted order lets you count runs directly.

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
