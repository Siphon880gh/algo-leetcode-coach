Given a 0-indexed array nums of length n, each minute one element is removed from the front until the array is empty; then each minute the elements are appended back in their original order until nums is whole again, and the process repeats. For each query [time, index], return the element at that index after time minutes, or −1 if the index does not exist then. For instance, nums = [0,1,2] with queries [0,2], [2,0], [3,2], [5,0] → [2,2,−1,0]; nums = [2] with queries [0,0], [1,0], [2,0], [3,0] → [2,−1,2,−1]. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Two phases

1. `t = time mod 2n`.
2. `t < n`: answer `nums[t + j]` when `j < n − t`, else −1.
3. `t ≥ n`: answer `nums[j]` when `j < t − n`, else −1.

Constructed checks (verified against step-by-step simulation): the two cases above → `[2,2,-1,0]`, `[2,-1,2,-1]`.

Each query is O(1), so time values far beyond n never need simulating.

Time: O(q)  
Space: O(1) besides the output

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
