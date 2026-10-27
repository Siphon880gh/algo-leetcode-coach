## Peak flags

1. flag[i] = 1 if 0 < i < n − 1 and nums[i] > both neighbours.
2. Count [l, r]: sum of flags on l + 1 … r − 1 (0 if r − l < 2).
3. Update i: set nums[i], then refresh the flags of i − 1, i, i + 1.

Examples → [0], [0, 1]. Checked against recounting on 300 random query lists.

The ends of a subarray cannot be peaks: counting them gives example 2 → [1, 1]. Recounting per query is about 10^10 steps at 10^5 each.

Time: O((n + q) log n)  
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
