Given an integer array `nums`, count the non-empty contiguous subarrays whose leftmost element is not larger than any other element of the subarray. `[1,4,2,5,3]` → 11. `[3,2,1]` → 3. `[2,2,2]` → 6. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Valid until something smaller appears

1. `nextSmaller[i] = n` by default. Scan left to right with a stack of indices: while `nums[stack top] > nums[i]`, pop `t` and set `nextSmaller[t] = i`. Push `i`.
2. Answer: `Σ (nextSmaller[i] − i)`.

Each popped index meets its first strictly smaller value, which ends its run of valid subarrays.

Do not pop on equal values; an equal element keeps the subarray valid. Do not check every subarray; that is O(n²).

Time: O(n)  
Space: O(n)

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
