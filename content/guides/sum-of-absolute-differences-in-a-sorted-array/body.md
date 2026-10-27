## Left and right parts

1. `T = sum(nums)`, running prefix `p` (sum before `i`).
2. `res[i] = x·i − p + (T − p − x) − x·(n − 1 − i)`; then `p += x`.

`[2,3,5]` → `[4,3,5]`. `[1,4,6,8,10]` → `[24,15,13,15,21]`.

Sortedness is what makes every left difference `x − nums[j]` non-negative. Do not loop over all pairs (O(n²)).

Time: O(n)  
Space: O(1) extra

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
