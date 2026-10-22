## Extend

1. `best = −1`.
2. For each i with `nums[i + 1] = nums[i] + 1`: `j = i + 1`; while `nums[j + 1] = nums[j − 1]`, `j += 1`; `best = max(best, j − i + 1)`.
3. Return best.

Examples → 4, 2. Checked against testing every subarray on 400 random arrays.

The first step must be +1, not −1: [3, 2, 1] has no alternating subarray, so the answer is −1. Length 1 does not count, which is why best starts at −1.

Time: O(n²), fine for n ≤ 100  
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
