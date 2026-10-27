## Alternate stones

1. `ans = stones[1] − stones[0]`.
2. For `i ≥ 2`: `ans = max(ans, stones[i] − stones[i − 2])`.
3. Return `ans`.

Examples → 5, 9. Checked against trying every split of the middle stones on 300 random rivers.

Any path must jump over each stone i − 1 from at or before i − 2 to at or after i on one of the two trips, so stones[i] − stones[i − 2] is a lower bound, and alternating stones meets it. Binary search on the cost also works but is not needed.

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
