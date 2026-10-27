## Pair them up

1. For `i` from 1 to `n / 2`: add `i` and `−i`.
2. If `n` is odd, add `0`.

`n = 5` → `[1,-1,2,-2,0]`; `n = 3` → `[1,-1,0]`; `n = 1` → `[0]`. Any valid array is accepted, such as the statement's `[-7,-1,1,3,4]`.

Do not add 0 for even `n`; the count would be off. Do not repeat a value; the integers must be unique.

Time: O(n)  
Space: O(1) besides the output

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
