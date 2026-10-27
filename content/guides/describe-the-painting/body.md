## Difference map

1. `d[start] += color`, `d[end] −= color`.
2. Sorted keys `x`; running `cur`; for each consecutive pair, after adding `d[x_i]`, emit `[x_i, x_{i+1}, cur]` if `cur > 0`.

Example 1 → `[[1,4,14],[4,7,16]]`. Example 2 → `[[1,6,9],[6,7,24],[7,8,15],[8,10,7]]`. Example 3 → `[[1,4,12],[4,7,12]]`.

Do not merge neighbours with equal sums: example 3 has two different sets that both sum to 12. Colours are unique, so endpoints are the only places the set can change. Sums can exceed 32 bits.

Time: O(n log n)  
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
