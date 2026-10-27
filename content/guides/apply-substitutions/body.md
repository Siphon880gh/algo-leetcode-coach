Each key is one uppercase letter mapped to a short value, and a text holds placeholders written %X%. A value may itself contain placeholders, and there are no cycles. Return the text with every placeholder replaced until none remain. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Memoized expansion

This assumes, as restated, that every placeholder names a known key and that there are no cycles.

1. expand(key): replace each %X% in its value with expand(X); store the result.
2. Replace each %X% in the text with expand(X).

Constructed checks (run in code): P = xy, Q = %P%z, text %Q%_%P% → xyz_xy; A = 1%B%, B = 2%C%, C = 3, text %A%_%C%_%B% → 123_3_23.

A single pass replacing keys in the order C, B, A: the second check → 1%B%_3_2%C%.

Time: O(size of the expanded output)  
Space: O(size of the expanded values)

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
