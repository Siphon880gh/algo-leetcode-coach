## Two states

1. `f = g = 1` (ending with nums1[i] or nums2[i]).
2. For i ≥ 1: `f’ = max(1, f + 1 if nums1[i] ≥ nums1[i − 1], g + 1 if nums1[i] ≥ nums2[i − 1])`; g’ likewise for nums2[i].
3. Return the largest f or g seen.

Examples → 2, 4, 2. Checked against trying all choices on 300 random small arrays.

Greedily taking the smallest value that keeps the run going can end a run that the larger value would have helped later: nums1 = [4, 2, 1, 5], nums2 = [4, 4, 3, 5] → 2 instead of 3.

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
