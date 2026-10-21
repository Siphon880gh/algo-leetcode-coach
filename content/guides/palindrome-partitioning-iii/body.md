## Two DPs

1. `cost[i][j] = cost[i + 1][j − 1] + (s[i] ≠ s[j])` (0 for length ≤ 1).
2. `f(i, 1) = cost[i][n − 1]`.
3. `f(i, k) = min(cost[i][j] + f(j + 1, k − 1))` for `j` from `i` to `n − k`.
4. Return `f(0, k)`.

`"abc"`, k = 2 → 1. `"aabbc"`, k = 3 → 0. `"leetcode"`, k = 8 → 0.

Do not recompute the palindrome cost inside the partition loop; precompute it. Do not let a piece be empty; leave at least one character for each remaining piece.

Time: O(n² · k)  
Space: O(n²)

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
