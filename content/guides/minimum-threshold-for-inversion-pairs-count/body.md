An inversion pair with threshold x is a pair i < j with nums[i] > nums[j] and nums[i] − nums[j] ≤ x. Return the smallest x giving at least k such pairs, or −1 if none does. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Monotone check

1. If the count at x = max − min is below k, return −1.
2. Binary search the smallest x with count(x) ≥ k.
3. count(x): for each v, add the number of earlier values in (v, v + x]; then insert v.

Constructed checks (run in code): [5, 1, 4, 2], k = 2 → 2; [3, 3, 1], k = 1 → 2; [1, 2, 3], k = 1 → −1. Checked against counting every pair for every x on 300 random arrays.

Counting differences strictly below x: the first check → 3 instead of 2.

Time: O(n log n · log(max − min))  
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
