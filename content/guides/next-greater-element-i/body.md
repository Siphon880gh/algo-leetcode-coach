`nums1` (length up to 1000) is a subset of `nums2` (length up to 1000), and all values are distinct. For each `x` in `nums1`, find `x` in `nums2` and return the first larger value to its right, or −1. `nums1 = [4,1,2]`, `nums2 = [1,3,4,2]` → `[−1,3,−1]`. `[2,4]`, `[1,2,3,4]` → `[3,−1]`. Follow-up: O(nums1.length + nums2.length).

## One stack pass, then a map

Walk `nums2` left to right with a stack of values that have not found a larger value yet. For each `y`: while the stack top is smaller than `y`, pop it and record `next[top] = y`. Push `y`. Values left on the stack at the end get −1. The stack stays decreasing from bottom to top. Then answer `nums1` by looking up `next[x]`.

Scanning right to left works too (doocs): pop values not larger than `y`, then the top (if any) is `y`'s answer.

Next Greater Element II (503) wraps around a circular array. Daily Temperatures (739) returns distances instead of values. Next Greater Element III (556) is about digit permutations — a different problem.

Do not search to the right for each query (O(n · m)). Values are distinct, so a map from value to answer is safe.

Time: O(m + n)  
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
