## Complement counting

1. `good = 0`, `cnt = {}`.
2. For each `i`: `k = nums[i] − i`; `good += cnt[k]`; `cnt[k]++`.
3. Return `n(n − 1) / 2 − good`.

Examples → 5, 0. Checked against every pair on 300 random arrays.

`j − i = nums[j] − nums[i]` rearranges to `nums[j] − j = nums[i] − i`, so good pairs share a key. With n = 10^5 the total is 4,999,950,000, so use 64-bit.

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
