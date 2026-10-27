## Pop what can come back

`last[c]` = last index of `c`. For each index `i` with letter `c`:

1. If `c` is already in the stack, skip it.
2. While the top is greater than `c` and `last[top] > i`, pop the top (and mark it as not in the stack).
3. Push `c`.

Return the stack as a string.

A larger letter on top can be dropped only if it reappears later, so every letter still ends up exactly once.

This is the same problem as Remove Duplicate Letters (316). Do not pop letters that do not occur again; they would be lost. Do not push a letter twice; the in-stack check keeps each one once.

Time: O(n)  
Space: O(26)

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
