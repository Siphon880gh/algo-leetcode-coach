## Bit by bit

1. If sum < target, return −1. Count powers per bit.
2. For bit i upward: if target needs it, use one cnt[i]; if none, find the smallest j > i with cnt[j] > 0 and split it down to i (j − i operations).
3. Carry `cnt[i] // 2` to bit i + 1.

Examples → 1, 2, −1. Checked against a breadth-first search over split sequences on 300 random small inputs.

Carrying the leftovers matters: two unused 1s can stand in for a 2 without any split. When the total reaches target, a larger power always exists to split.

Time: O(n + 31²)  
Space: O(31)

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
