## Two deques

1. For each r: push r onto a decreasing deque (max) and an increasing deque (min).
2. While `max − min > 2`: advance l, dropping deque fronts below l.
3. Add `r − l + 1`.

Examples → 8, 6. Checked against testing every subarray on 400 random arrays.

The total can reach n(n + 1) / 2 ≈ 5 · 10^9 for n = 10^5, so use 64-bit. A sorted map of counts also works in O(n log n).

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
