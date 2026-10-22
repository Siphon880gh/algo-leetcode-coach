## Mask and last

1. `dp[1 << i][i] = 1`.
2. For each mask and last, for each unused j with `nums[j] % nums[last] = 0` or the reverse: `dp[mask | 1 << j][j] += dp[mask][last]`.
3. Return the sum of `dp[full][·]` mod 10^9 + 7.

Examples → 2, 2. Checked against trying every permutation on 200 random small arrays.

With n ≤ 14 there are 14! ≈ 8.7 · 10^10 permutations, but only 2^14 · 14 · 14 ≈ 3.2 million DP transitions.

Time: O(2^n · n²)  
Space: O(2^n · n)

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
