Given three strictly increasing integer arrays, return the sorted list of values that appear in all three. For instance, `[1,2,3,4]`, `[1,3,5]`, and `[1,3,9]` give `[1,3]`. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Advance the smallest

1. `i = j = k = 0`.
2. While all are in range: if `a[i] == b[j] == c[k]`, append and advance all three; else advance whichever points at the smallest value.
3. Return the list.

The smallest value cannot be in all three if it is below another current value, since every array is increasing.

A counting map also works, but the pointers use O(1) extra space.

Do not advance all pointers on a mismatch; you could skip a match. Do not intersect with sets and forget to sort the result.

Time: O(n1 + n2 + n3)  
Space: O(1) besides the output

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
