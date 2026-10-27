## Count the two mismatch types

1. `xy` = positions with `s1[i] = x`, `s2[i] = y`; `yx` the other way.
2. If `xy + yx` is odd, return −1.
3. Return `xy // 2 + yx // 2 + 2 · (xy % 2)`.

Two `xy` positions: swap `s1[i]` with `s2[j]` → both fixed in 1 swap. One `xy` and one `yx` take 2 swaps.

`"xx"`, `"yy"` → 1. `"xy"`, `"yx"` → 2. `"xx"`, `"xy"` → −1.

Do not count total x and y only; the type of each mismatch decides the cost. Do not forget that swaps go between the two strings, not within one.

Time: O(n)  
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
