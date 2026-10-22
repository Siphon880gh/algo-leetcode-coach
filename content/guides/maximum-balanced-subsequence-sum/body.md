## Fenwick over keys

1. If every value is ≤ 0, return the maximum value.
2. Compress keys `nums[i] − i`. For each i with nums[i] > 0: `v = nums[i] + max over keys ≤ key(i)`; store v at key(i).
3. Return the best v.

Examples → 14, 13, −1. Checked against testing every subsequence on 500 random arrays.

Non-positive elements never raise a sum that already has a positive one, so they are skipped; without step 1, example 3 → 0 instead of −1.

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
