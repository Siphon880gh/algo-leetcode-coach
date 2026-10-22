## Fixed window

1. For each `i`: add `nums[i]` to the counts and the sum; if `i ≥ k`, remove `nums[i − k]`, deleting its key when the count hits 0.
2. Once `i ≥ k − 1`, if the map has `k` keys, `best = max(best, sum)`.
3. Return `best`, which stays 0 if no window qualifies.

Examples → 15, 0. Checked against testing every window on 300 random arrays.

Delete keys at count 0, or the map size will overstate the distinct values. Sums reach 10^5 · 10^5 = 10^10, so use 64-bit.

Time: O(n)  
Space: O(k)

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
