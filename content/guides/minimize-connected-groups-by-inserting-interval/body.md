You are given intervals and an integer k. Add exactly one interval of length at most k so the number of connected groups (maximal sets that cover a range with no gaps) is as small as possible, and return that number. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Merge and reach

This assumes touching endpoints connect (as in [1, 3] and [3, 5]) and length means end − start.

1. Sort and merge into groups; g = count.
2. For each group i: j = last group with start ≤ end_i + k; saving = j − i.
3. Answer g − max saving.

Constructed checks (run in code): [[1, 3], [5, 6], [8, 10]], k = 3 → 2; [[1, 1], [2, 2], [3, 3]], k = 2 → 1; [[1, 2], [4, 4], [7, 9]], k = 1 → 3. Checked against trying every integer interval on 400 random cases.

Closing only one gap: the second check → 2 instead of 1.

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
