## Look at the minimum

1. m = min(nums). If any x mod m ≠ 0, return 1.
2. Else c = count of m; return (c + 1) / 2 with integer division.

Examples → 1, 2, 1. Checked against searching every sequence of operations on 300 random small arrays.

A unique smallest value s removes any larger y with s mod y = s, so it eats the array one by one. Rounding c / 2 down is wrong: example 2 has c = 4 → 2 either way, but [5, 5, 5] → 2, not 1.

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
