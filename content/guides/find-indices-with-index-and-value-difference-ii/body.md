## Running extremes

1. For j from indexDifference: i = j − indexDifference; update mn and mx (indices of smallest and largest value up to i).
2. If `nums[j] − nums[mn] ≥ v` return [mn, j]; if `nums[mx] − nums[j] ≥ v` return [mx, j].
3. Return [−1, −1].

Examples → [0, 3], [0, 0], [−1, −1]. Checked against testing every pair on 1000 random inputs.

n reaches 10^5, so every pair is about 10^10 checks.

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
