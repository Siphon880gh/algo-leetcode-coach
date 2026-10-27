## One pass with two maxima

`cut = 0`, `leftMax = nums[0]`, `seenMax = nums[0]`.

For `i` from 1 to `n − 1`:

- `seenMax = max(seenMax, nums[i])`.
- If `nums[i] < leftMax`: `cut = i`, `leftMax = seenMax`.

Return `cut + 1`.

Every element after the final cut is at least `leftMax`, and everything before it is at most `leftMax`, so the split is valid. Moving the cut only when forced keeps the left part as small as possible.

The two-array version also works: `prefixMax[i] ≤ suffixMin[i + 1]` at the first such `i`.

Do not move the cut on `≤`; equal values may stay on the right. Do not set `leftMax` to `nums[i]`; the left part now includes everything up to `i`.

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
