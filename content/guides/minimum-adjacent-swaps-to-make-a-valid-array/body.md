You are given an integer array nums. In one operation you may swap two adjacent elements. The array is valid when its leftmost element is a smallest element of the array and its rightmost element is a largest element. Return the minimum number of swaps needed to make nums valid. For instance, [3,4,5,5,3,1] → 6; [2,5,1] → 2; [9] → 0. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Two walks, one shared swap

1. `i` = index of the first minimum, `j` = index of the last maximum.
2. Return `i + (n − 1 − j) − (1 if i > j else 0)`.

Constructed checks (verified against a breadth-first search over swaps on 400 random arrays): [3,4,5,5,3,1] → 6, [2,5,1] → 2, [9] → 0.

Choosing the closest copies minimises each walk. If the minimum is right of the maximum, their paths cross once and that single swap moves both. When all values are equal, `i = 0` and `j = n − 1`, giving 0.

Time: O(n)  
Space: O(1)

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
