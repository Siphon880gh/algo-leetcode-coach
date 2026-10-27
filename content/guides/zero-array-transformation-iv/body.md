## Bitset per index

1. For each j with nums[j] > 0: bits = {0}; for each query i covering j, bits |= bits << val (cut at nums[j]); stop at the first i where nums[j] is reachable and record i + 1. If never, return −1.
2. Answer the largest recorded count (0 if all are 0).

Examples → 2, −1, 4, 4. Checked against trying every subset of every prefix on 300 random cases.

Subtracting each covering val greedily when it fits: nums = [5], queries = [[0, 0, 3], [0, 0, 4], [0, 0, 4], [0, 0, 1]] → −1 instead of 4.

Time: O(n · q · max(nums))  
Space: O(max(nums))

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
