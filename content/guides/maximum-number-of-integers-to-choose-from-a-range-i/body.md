## Smallest first

1. Put `banned` in a set; `sum = count = 0`.
2. For `i = 1 … n`: skip banned `i`; if `sum + i > maxSum`, stop; else add it.
3. Return `count`.

Examples → 2, 0, 7. Checked against trying every subset on 300 random small cases.

Swapping any chosen number for a smaller unused one keeps the count and lowers the sum, so the smallest numbers are best. Once one number does not fit, no larger one does.

Time: O(n + banned)  
Space: O(banned)

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
