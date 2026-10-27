## New song or replay

`dp[0][0] = 1`. For `i` from 1 to `goal`, `j` from 1 to `min(i, n)`:

- New song: `dp[i − 1][j − 1] · (n − (j − 1))`.
- Replay: `dp[i − 1][j] · max(j − k, 0)`: the last `k` songs played are all different and all among the `j`, so `j − k` songs are allowed.

`dp[i][j]` is the sum mod 10⁹ + 7. The answer is `dp[goal][n]`, since every song must play at least once.

Do not count replays as `j` choices; the last `k` songs are blocked. Do not let `j` exceed `n` or `i`.

Time: O(goal · n)  
Space: O(goal · n), or O(n) with a rolling row

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
