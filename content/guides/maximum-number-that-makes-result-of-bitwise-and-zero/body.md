You are given an integer n. Find the largest x such that the bitwise AND of all integers from x through n is 0. Limits are in the official statement. For instance, n = 7 → 3. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Top bit

1. b = index of n’s highest set bit. Return 2^b − 1.

Constructed checks (run in code): 7 → 3, 9 → 7, 17 → 15, 1 → 0; every n < 300 matches brute force.

Any x ≥ 2^b keeps bit b in every number, so the AND is not 0.

Time: O(1)  
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
