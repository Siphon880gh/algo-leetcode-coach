## Z-array in linear time

1. `Z[0] = n`; keep the rightmost match window `[l, r)`.
2. For `i ≥ 1`: start from `min(r − i, Z[i − l])` when `i < r`, then extend while characters match; update `[l, r)`.
3. Return `Σ Z`.

Examples → 9, 14. Checked against direct prefix comparison on 300 random strings.

Each s_i is a suffix of s, so its score is a prefix match between s and that suffix. n reaches 10^5, so the sum can reach about 5 · 10^9; use 64-bit.

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
