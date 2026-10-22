You are given an integer array nums. Among index triples i < j < k with nums[i] < nums[j] < nums[k], find the largest value of the triple, computed from the three elements by the formula the statement gives. The formula and limits are in the official statement. For instance, with the value taken as nums[i] − nums[j] + nums[k], nums = [5, 6, 9] → 8. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Middle element

This assumes the value is nums[i] − nums[j] + nums[k], so it grows with nums[i] and nums[k]. If the official formula differs, keep the idea (best partner on each side of j) and adjust what “best” means.

1. suf[j + 1] = maximum of nums after j.
2. Sweep j left to right with a sorted set of earlier values. If suf[j + 1] > nums[j] and some earlier value is below nums[j], take the largest such value a: candidate = a − nums[j] + suf[j + 1].
3. Insert nums[j]; return the best candidate.

Constructed checks (run in code): the example above; [1, 5, 3, 6] → 4; 3,000 random arrays match trying every triple.

Take the largest smaller value on the left, not the nearest one: [5, 7, 2, 6, 8] → 6 instead of 7 (5, 6, 8).

Time: O(n log n)  
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
