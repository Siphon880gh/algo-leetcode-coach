## Components

1. For each i: `seen = {}`, `c = 0`.
2. For j = i … n − 1 with `x = nums[j]`: if x is new, `c += 1 − [x − 1 ∈ seen] − [x + 1 ∈ seen]` and add x.
3. Add `c − 1` to the total for each j.

Examples → 3, 8. Checked against sorting every subarray on 400 random arrays.

Skip repeated values: they do not change the gaps, and counting them again gives example 2 → 20 instead of 8.

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
