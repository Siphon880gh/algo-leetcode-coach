## Biggest and smallest valid numbers

1. Max: the first digit `d ≠ 9`; replace every `d` with 9.
2. Min: if `s[0] ≠ 1`, replace every `s[0]` with 1. Else find the first later digit not in {0, 1} and replace every one with 0.
3. Return `max − min`.

555 → 999 − 111 = 888. 9 → 9 − 1 = 8. 123456 → 923456 − 103456 = 820000.

Do not replace the first digit with 0 (leading zero). Do not replace a later 1 with 0 when the leading digit is 1; that changes the leading digit too.

Time: O(digits)  
Space: O(digits)

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
