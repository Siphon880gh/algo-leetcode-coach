## Extend

1. For each l with `nums[l]` even and `≤ threshold`: extend r while `nums[r + 1] ≤ threshold` and its parity differs from `nums[r]`.
2. Track the longest `r − l + 1`.

Examples → 3, 1, 3. Checked against testing every subarray on 400 random cases.

The start must be even: [3, 2, 5, 4] alternates and fits the threshold but starts odd, so ignoring that rule gives example 1 → 4 instead of 3. Jumping l to r + 1 after each run makes this O(n), but n ≤ 100 lets the simple version pass.

Time: O(n²), O(n) with the jump  
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
