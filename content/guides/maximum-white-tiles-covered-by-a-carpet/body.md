## Two pointers over sorted tiles

1. Sort by `l`; `j = 0`, `cov = 0`.
2. For each `i`: `e = l_i + carpetLen − 1`; while `r_j ≤ e`: `cov += r_j − l_j + 1`, `j++`; `best = max(best, cov + max(0, e − l_j + 1))` (partial term only if `j < n`); then remove tile `i` from `cov`.

Examples → 9, 2. Checked against trying every start position on 300 small cases.

Shifting a carpet left until its left edge meets a tile’s start never loses white tiles, so only n starts matter. Tiles do not overlap, which keeps the running sum exact.

Time: O(n log n)  
Space: O(1) beyond sorting

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
