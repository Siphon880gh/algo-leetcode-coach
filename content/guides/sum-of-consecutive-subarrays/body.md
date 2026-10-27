An array is consecutive if every step is +1, or every step is −1; a single element counts. Return the sum of the element sums of all consecutive subarrays, modulo the value the statement gives. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Two running pairs

1. Up: if x − prev = 1, cnt += 1 and sum += cnt · x; else cnt = 1 and sum = x. Down likewise with −1.
2. ans += up_sum + down_sum − x (mod the given modulus).

Constructed checks (run in code): [1, 2, 3] → 20; [1, 3, 5, 7] → 16; [7, 6, 1, 2] → 32. Checked against every subarray on 300 random arrays.

Not subtracting the singletons: [1, 2, 3] → 26 instead of 20.

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
