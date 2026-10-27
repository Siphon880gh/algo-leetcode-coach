A lucky number uses only the digits 4 and 7. Given k, return the k-th smallest lucky number. The return type and limits are in the official statement. For instance, the lucky numbers begin 4, 7, 44, 47, 74, 77, 444, so k = 4 → 47 and k = 10 → 477. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Shifted binary

1. `b` = binary of k + 1.
2. Drop its leading 1; replace 0 with 4 and 1 with 7.

Constructed checks (run in code): k = 1, 4, 10 → 4, 47, 477; the first 199 values match listing lucky numbers in order.

There are 2^L lucky numbers of length L, so the first k of them fill lengths 1, 2, … like the numbers 2 … k + 1 in binary. Using k itself shifts everything: k = 4 → 44 instead of 47.

Time: O(log k)  
Space: O(log k)

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
