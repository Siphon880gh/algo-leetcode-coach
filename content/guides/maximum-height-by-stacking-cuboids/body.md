## Normalise, then chain

1. Sort each cuboid's dimensions ascending; sort the list.
2. `dp[i] = c[i][2] + max(dp[j])` for `j < i` with `c[j][k] ≤ c[i][k]` for all `k`.
3. Return `max(dp)`.

`[[50,45,20],[95,37,53],[45,23,12]]` → 190. `[[38,25,45],[76,35,3]]` → 76. Six rotations of `[7,11,17]` → 102.

Using the largest dimension as height is optimal: if one cuboid fits on another, their sorted dimensions also fit. n ≤ 100 makes O(n²) trivial.

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
