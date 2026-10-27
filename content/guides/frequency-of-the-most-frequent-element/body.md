## Raise to the right end

1. Sort; `l = 0`, `sum = 0`.
2. For each `r`: `sum += nums[r]`; while `nums[r] · (r − l + 1) − sum > k`: `sum −= nums[l]`, `l += 1`.
3. `best = max(best, r − l + 1)`.

`[1,2,4], 5` → 3. `[1,4,8,13], 5` → 2. `[3,9,6], 2` → 1.

Only increments are allowed, so the target is the window's maximum. Use 64-bit for `nums[r] · len` (up to 10^10).

Time: O(n log n)  
Space: O(1) besides sorting

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
