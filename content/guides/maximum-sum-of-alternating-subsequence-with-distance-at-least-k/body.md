## DP

1. Compress values.
2. At i, first insert j = i − k: down[j] into tree A at rank(nums[j]), up[j] into tree B at reversed rank.
3. up[i] = nums[i] + max of A over smaller values; down[i] = nums[i] + max of B over larger values (0 when empty).
4. Return the largest value seen.

Examples → 7, 14, 5. Checked against every subsequence on 1,500 random arrays.

Ignoring k: example 1 → 9 instead of 7.

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
