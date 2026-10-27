## Unique-window sum

1. For each `x`: while `x` is in `seen`, remove `nums[l]` from `seen` and the sum; `l += 1`.
2. Add `x`; update `best = max(best, sum)`.

`[4,2,4,5,6]` → 17 (`[2,4,5,6]`). `[5,2,1,2,5,2,1,2,5]` → 8 (`[5,2,1]` or `[1,2,5]`).

Values are positive, so the longest unique window ending at r always has the largest sum among those windows. A last-index map plus prefix sums also works.

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
