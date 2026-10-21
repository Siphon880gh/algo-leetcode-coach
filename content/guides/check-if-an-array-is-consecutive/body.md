An array nums of length n is consecutive if it contains every number in the range [x, x + n − 1], where x is its minimum. Return true if nums is consecutive. For instance, [1,3,4,2] → true; [1,3] → false; [3,5,4] → true. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Two checks

Return `|set(nums)| = n` and `max − min = n − 1`.

Constructed checks: the three cases above → true, false, true.

n distinct integers inside a range of n values must fill it exactly. Sorting and checking neighbours differ by 1 works too, in O(n log n).

Time: O(n)  
Space: O(n)

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
