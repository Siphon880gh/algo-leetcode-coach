## Sort and group

1. Sort indices by value; start a new group when the gap to the previous value exceeds limit.
2. For each group, write its sorted values into its sorted indices.

Examples → [1, 3, 5, 8, 9], [1, 6, 7, 18, 1, 2], [1, 7, 28, 19, 10]. Checked against exploring every reachable array on 600 random small inputs.

Swaps are not limited to neighbours in the array, and values connect through a chain: [3, 1, 2] with limit 1 → [1, 2, 3], although 3 and 1 can never swap directly.

Time: O(n log n)  
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
