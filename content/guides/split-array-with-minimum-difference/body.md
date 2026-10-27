## Two flag arrays

1. inc[i] = nums[0 … i] is strictly increasing; dec[i] = nums[i … n − 1] is strictly decreasing.
2. For each split after i (0 ≤ i ≤ n − 2) with inc[i] and dec[i + 1]: try |left sum − right sum|.
3. Return the smallest, or −1 if no split is valid.

Examples → 2, 4, −1. Checked against testing every split on 3,000 random arrays.

Allowing equal neighbors: [2, 2, 2] → 2 instead of −1.

Time: O(n)  
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
