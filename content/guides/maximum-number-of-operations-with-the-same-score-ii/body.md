## Three targets

1. For t in {nums[0] + nums[1], nums[n − 2] + nums[n − 1], nums[0] + nums[n − 1]}:
2. f(i, j) = 0 if j − i < 1; else the max of 1 + f(i + 2, j), 1 + f(i, j − 2), 1 + f(i + 1, j − 1) over the moves whose pair sums to t.
3. Return the best f(0, n − 1).

Examples → 3, 2. Checked against trying every sequence of moves on 2,000 random small arrays.

A greedy that takes the first valid move (first two, then last two, then both ends) is wrong even when it tries all three scores: [2, 4, 1, 1, 2, 3] → 1 instead of 2. With score 5 it takes the last two and gets stuck; taking both ends first, then the first two, makes 2. The DP has about n² / 2 ≈ 2 · 10^6 states per score.

Time: O(n²)  
Space: O(n²)

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
