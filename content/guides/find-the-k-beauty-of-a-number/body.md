## Every window

1. `s = str(num)`.
2. For `i = 0 … len(s) − k`: `v = int(s[i … i + k − 1])`; count it if `v ≠ 0` and `num mod v = 0`.

Examples → 2, 2.

Leading zeros are allowed, so 04 counts as 4; a window of all zeros is 0 and must be skipped before dividing. num < 2^31, so there are at most 10 windows.

Time: O(len(s) · k)  
Space: O(len(s))

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
