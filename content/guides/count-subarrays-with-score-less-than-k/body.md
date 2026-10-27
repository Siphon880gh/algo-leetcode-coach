## Window per right end

1. `l = 0`, `sum = 0`.
2. For each `r`: `sum += nums[r]`; while `sum · (r − l + 1) ≥ k`: `sum −= nums[l]`, `l++`.
3. Add `r − l + 1`: every subarray ending at `r` and starting at `l` or later qualifies.

Examples → 6, 5. Checked against scoring every subarray on 300 random arrays.

The score is strictly below k, so shrink while it is ≥ k. sum reaches 10^10 and sum · length 10^15, so use 64-bit.

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
