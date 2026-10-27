## Include or skip

1. `cnt` counts chosen values. `go(i)`: if `i = n`, return 1.
2. `r = go(i + 1)` (skip). If `cnt[nums[i] − k] = 0` and `cnt[nums[i] + k] = 0`: choose it, `r += go(i + 1)`, unchoose.
3. Return `go(0) − 1` to drop the empty subset.

Examples → 4, 1. Checked against testing all 2^n subsets on 300 random arrays.

Equal values never conflict with each other since k ≥ 1. Grouping by value mod k gives a faster house-robber style count, but 2^18 is small enough here.

Time: O(2^n)  
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
