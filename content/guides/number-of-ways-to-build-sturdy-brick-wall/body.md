You are given height, width and a list of brick widths; every brick is 1 unit tall, supply is unlimited, and bricks cannot be rotated. Each row must be exactly width long. The wall is sturdy when adjacent rows never have a joint between bricks at the same position, except at the two ends. Return the number of sturdy walls modulo 10^9 + 7. The width is small. For instance, height 2, width 3, bricks [1,2] → 2; height 1, width 1, bricks [5] → 0. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Rows as joint masks

1. DFS widths from 0 to `width`, setting bit `p` for each inner joint `p`; collect all row masks.
2. `dp[m] = 1` for every mask (first row).
3. Repeat `height − 1` times: `new[m] = Σ dp[m′]` over `m′` with `m AND m′ = 0` (mod 10^9 + 7).
4. Return `Σ dp`.

Constructed checks (verified against trying every stack of rows): the two cases above → 2, 0; height 1, width 3, bricks [1,2] → 3.

Precomputing the compatible pairs once avoids redoing the AND tests on every row.

Time: O(height · R²), R = row patterns  
Space: O(R²)

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
