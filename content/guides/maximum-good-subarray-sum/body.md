## Smallest prefix per value

1. mn = map from value to smallest pre[i] over indices i with that value; pre = running sum.
2. For each j: first record mn[nums[j]] with the sum before j; add nums[j]; then for v = nums[j] ± k in mn, candidate = pre − mn[v].
3. Return the best candidate, or 0 if there is none.

Examples → 11, 11, −6. Checked against every subarray on 2,000 random arrays.

The best good sum can be negative: starting the maximum at 0 gives example 3 → 0 instead of −6. Sums reach about 10^14; use 64-bit.

Time: O(n)  
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
