## OR in, XOR out

1. `mask = 0`, `l = 0`.
2. For each `r`: while `mask & nums[r] ≠ 0`, `mask ^= nums[l]`, `l++`. Then `mask |= nums[r]`; `best = max(best, r − l + 1)`.
3. Return `best`.

Examples → 3, 1. Checked against testing every subarray on 300 random arrays.

Because the window’s numbers share no bits, OR equals XOR equals the sum of them, so XOR removes a number exactly. Values are below 2^30, so a nice window holds at most 30 numbers.

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
