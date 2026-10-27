## Walk aligned diagonals

1. For each `i` in `s` and `j` in `t`: `d = 0`; for `k = 0, 1, …`:
2. `d += s[i + k] ≠ t[j + k]`; if `d == 1`, count one; if `d > 1`, stop.

`"aba"`, `"baba"` → 6. `"ab"`, `"bb"` → 3.

O(n³) with lengths ≤ 100 is fine. An O(n²) version counts, for each mismatch, the equal run to its left times the equal run to its right. Do not count substring pairs with zero mismatches.

Time: O(|s| · |t| · min)  
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
