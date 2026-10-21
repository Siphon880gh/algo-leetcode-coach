## Which one to change

Scan for `i` with `nums[i] > nums[i + 1]`. On the first one:

- If `i == 0` or `nums[i − 1] ≤ nums[i + 1]`: set `nums[i] = nums[i + 1]`. Lowering the left value is best, because it keeps the future as easy as possible.
- Otherwise: set `nums[i + 1] = nums[i]`. Lowering `nums[i]` would break the pair before it, so raise the right value instead.

Keep scanning; if another dip appears, return false.

Do not only count the dips; `[3,4,2,3]` has one dip but needs two changes, and the rewrite above catches it. Do not always lower `nums[i]`; in `[3,4,2,5]` lowering 4 to 2 breaks `3 ≤ 2`, but raising 2 to 4 works.

Time: O(n)  
Space: O(1)

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
