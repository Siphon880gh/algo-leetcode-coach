## Every split, O(1) check

1. Z0 = Z-function of nums; for each i, Zi = Z-function of nums[i:].
2. For i = 1 … n − 2 and j = i + 1 … n − 1: count the split if (i ≤ j − i and Z0[i] ≥ i) or (j − i ≤ n − j and Zi[j − i] ≥ j − i).

Examples → 2, 0. Checked against slicing every split on 400 random arrays. An lcp[i][j] DP works too but needs about 25 · 10^6 cells.

Adding the two conditions instead of OR-ing them: [1, 1, 1, 1] → 4 instead of 3.

Time: O(n²)  
Space: O(n)

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
